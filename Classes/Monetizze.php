<?php

class Monetizze {
    private $quantidadeDezenas;

    private $resultado;

    private $totalJogos;

    private $jogos;

    public function __construct($quantidadeDezenas, $totalJogos)
    {
        if ($quantidadeDezenas >= 6 && $quantidadeDezenas <= 10) {
            $this->quantidadeDezenas = $quantidadeDezenas;
        } else {
            throw new Exception('Quantidade incorreta de dezenas.');
        }

        $this->totalJogos = $totalJogos;
    }

    public function setQuantidadeDezenas($quantidadeDezenas)
    {
        $this->quantidadeDezenas = $quantidadeDezenas;

        return $this;
    }

    public function getQuantidadeDezenas()
    {
        return $this->quantidadeDezenas;
    }

    public function setResultado($resultado)
    {
        $this->resultado = $resultado;

        return $this;
    }

    public function getResultado()
    {
        return $this->resultado;
    }

    public function setTotalJogos($totalJogos)
    {
        $this->totalJogos = $totalJogos;

        return $this;
    }

    public function getTotalJogos()
    {
        return $this->totalJogos;
    }

    public function setJogos($jogos)
    {
        $this->jogos = $jogos;

        return $this;
    }

    public function getJogos()
    {
        return $this->jogos;
    }

    /**
     * 4. Desenvolver um método privado que retorne um array com dezenas entre 01 e 60
     * que respeite a cardinalidade definida pelo atributo “Quantidade de dezenas” onde as
     * dezenas nunca se repitam e estejam na ordem crescente.
     */
    private function dezenas()
    {
        $dezenas = [];

        while (count($dezenas) < $this->quantidadeDezenas) {
            $numero = random_int(1, 60);

            if (!in_array($numero, $dezenas)) {
                $dezenas[] = $numero;
            }
        }

        sort($dezenas);

        return $dezenas;
    }

    /**
     * 5. Desenvolver um método público que selecione a quantidade de jogos que está
     * setado no atributo “Total jogos” obtendo assim um array multidimensional onde cada
     * posição deste array deverá conter outro array com um jogo. Use o método anterior
     * para gerar cada jogo e salve este array multidimensional no atributo “Jogos”.
     */
    public function gerarJogos()
    {
        $jogos = [];

        for ($i = 0; $i < $this->totalJogos; $i++) {
            $jogos[] = $this->dezenas();
        }

        $this->jogos = $jogos;
    }

    /**
     * 6. Desenvolver um método público que realize o sorteio de 6 dezenas aleatórias
     * entre * 01 e 60. Os números não podem se repetir e devem estar em ordem crescente.
     * O array resultante deverá ser armazenado no atributo “Resultado”.
     */
    public function gerarResultado()
    {
        $resultado = [];

        while (count($resultado) < 6) {
            $numero = random_int(1, 60);

            if (!in_array($numero, $resultado)) {
                $resultado[] = $numero;
            }
        }

        sort($resultado);

        $this->resultado = $resultado;
    }

    /**
     * 7. Desenvolver um método que confere todos os jogos e retorna uma tabela HTML
     * que contem os jogos e quantas dezenas foram sorteadas em cada jogo.
     */
    public function verificaResultado()
    {
        if ($this->jogos == null) {
            return 'Nenhum jogo criado.';
        }

        if ($this->resultado == null) {
            return 'Resultado ainda não foi gerado.';
        }

        $html = '<style>
                td, th {
                    border: 1px solid #dddddd;
                    text-align: left;
                    padding: 8px;
                }

                tr:nth-child(even) {
                    background-color: #dddddd;
                }

                .correct {
                    color: green;
                }

                .incorrect {
                    color: red;
                }
            </style>
            <table>';

        for ($i = 0; $i < count($this->jogos); $i++) {
            $html .= '<tr>';

            for ($j = 0; $j < count($this->jogos[$i]); $j++) {
                $html .= '<td class="' . (in_array($this->jogos[$i][$j], $this->resultado) ? 'correct' : 'incorrect') . '">' . $this->jogos[$i][$j] . '</td>';
            }

            $html .= '</tr>';
        }

        $html .= '</table>';

        return $html;
    }
}
