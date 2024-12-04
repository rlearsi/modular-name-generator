<?php

class Main {
    protected array $start = [];
    protected array $middle = [];
    protected array $end = [];

    public function __construct(array $start, array $middle, array $end) {
        $this->start = $start;
        $this->middle = $middle;
        $this->end = $end;
    }

    public function generateNick(int $lenght): string {
        $nickname = '';
        if ($lenght >= 1 && !empty($this->start)) {
            $nickname .= $this->start[array_rand($this->start)];
        }
        if ($lenght >= 2 && !empty($this->middle)) {
            $nickname .= $this->middle[array_rand($this->middle)];
        }
        if ($lenght >= 3 && !empty($this->end)) {
            $nickname .= $this->end[array_rand($this->end)];
        }
        return ucfirst(trim($nickname));
    }
}

class NicknamesGenerator {
    private $styles = [];

    public function __construct() {
        foreach (glob(__DIR__ . '/modules/*.txt') as $file) {
            $style = strtolower(basename($file, '.txt'));
            $data = $this->styleLoad($file);
            if ($data) {
                $this->styles[$style] = new Main(
                    $data['start'],
                    $data['middle'],
                    $data['end']
                );
            }
        }
    }

    private function styleLoad(string $file): ?array {
        $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if (count($lines) < 3) {
            return null;
        }

        return [
            'start' => array_map('trim', explode(',', $lines[0])),
            'middle' => array_map('trim', explode(',', $lines[1])),
            'end' => array_map('trim', explode(',', $lines[2])),
        ];
    }

    public function generate(string $style, int $lenght = 3): string {
        $style = strtolower($style);
        if (isset($this->styles[$style])) {
            return $this->styles[$style]->generateNick($lenght);
        }
        return "Style '$style' don't found!";
    }

    public function styleList(): array {
        return array_keys($this->styles);
    }
}

//$currentUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$currentUrl = "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']) . '/';

$gerador = new NicknamesGenerator();

// Gerar os links para os estilos
$styles = $gerador->styleList();
$links = [];

foreach ($styles as $style) {

    $links[] = "<a href='{$currentUrl}{$style}'>{$style}</a>";

}

echo "<b>Available styles:</b> " . implode(', ', $links) . '</br></br>';

// Captura o estilo da URL (parâmetro "url" no .htaccess)
$style = isset($_GET['url']) ? $_GET['url'] : 'english'; // Define um estilo padrão caso não seja passado

echo "Chosen style: " . ucfirst($style) . "<br>";

echo "<h1>" . $gerador->generate($style, 3) . "</h1>";

echo "<br>"; 


