<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Fibonacci
 *
 * @author pedrojsaba
 */
class Fibonacci extends CI_Controller {

    public $fibonacciCache = array();

    public function index() {
        echo anchor(base_url('/fibonacci/lineal1/10'), 'Lineal - Modo 1', 'target="_blank"').'<br>';
        echo anchor(base_url('/fibonacci/lineal2/10'), 'Lineal - Modo 2', 'target="_blank"').'<br>';
        echo anchor(base_url('/fibonacci/exponencial/10'), 'Exponencial', 'target="_blank"').'<br>';
    }

    public function exponencial($id) {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '2048M');
        echo "********** Complexity: O(2^N) **********" . "<br>";
        $starttime = microtime(true);
        echo 'Resultado: ' . $this->fibonacci1($id) . "<br>";
        $endtime = microtime(true);
        echo "Tiempo: " . number_format(($endtime - $starttime), 20, '.', '') . "<br>";
    }

    public function lineal1($id) {
        echo "********** Complexity: O(N) **********" . "<br>";
        $starttime = microtime(true);
        echo 'Resultado: ' . $this->fibonacci2($id) . "<br>";
        $endtime = microtime(true);
        echo "Tiempo: " . number_format(($endtime - $starttime), 20, '.', '') . "<br>";
    }

    public function lineal2($id) {
        echo "********** Complexity: O(N) **********" . "<br>";
        $starttime = microtime(true);
        echo 'Resultado: ' . $this->fibonacci3($id) . "<br>";
        $endtime = microtime(true);
        echo "Tiempo: " . number_format(($endtime - $starttime), 20, '.', '') . "<br>";
    }

    /// Complexity: O(2^N)
    private function fibonacci1($n) {
        if ($n < 0) {
            throw new Exception("N can not be less than zero");
        }
        if ($n <= 2) {
            return 1;
        }
        return $this->fibonacci1($n - 1) + $this->fibonacci1($n - 2);
    }

    /// Complexity: O(N)
    private function fibonacci2($n) {
        if ($n < 0) {
            throw new Exception("N can not be less than zero");
        }
        if ($n <= 2) {
            return 1;
        }
        $fibonacci = 0;
        $previous = 1;
        $penultimate = 0;
        for ($i = 1; $i <= $n; $i++) {
            $penultimate = $fibonacci;
            $fibonacci = $previous + $fibonacci;
            $previous = $penultimate;
        }
        return number_format($fibonacci, 0, '', '');
    }

    /// Complexity: O(N)
    private function fibonacci3($n) {
        if (count($this->fibonacciCache) == 0) {
            $this->fibonacciCache = $this->init($n);
        }
        if ($n < 0) {
            throw new Exception("N can not be less than zero");
        }

        if ($n <= 2) {
            $this->fibonacciCache[$n] = 1;
        }

        if ($this->fibonacciCache[$n] == 0) {
            $this->fibonacciCache[$n] = $this->fibonacci3($n - 1) + $this->fibonacci3($n - 2);
        }
        return $this->fibonacciCache[$n];
    }

    private function init($n) {
        $arr = array();
        for ($i = 0; $i <= $n; $i++) {
            $arr[$i] = 0;
        }
        return $arr;
    }

}
