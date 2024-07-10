<?php

class Alerta
{
    public function add_alerta($mensaje, $tipo)
    {
        $_SESSION['alertas'][] = [
            'tipo' => $tipo,
            'mensaje' => $mensaje,
        ];
    }

    public function get_alertas()
    {
        $html = '';
        if (!empty($_SESSION['alertas'])) {
            foreach ($_SESSION['alertas'] as $alerta) {
                $html .= $this->print_alerta($alerta);
            }
        }
        $this->clear_alertas();
        return $html;
    }

    public function clear_alertas(){
        $_SESSION["alertas"] = [];
    }

    public function print_alerta($alerta)
    {
        $html = "<div class='alert alert-{$alerta['tipo']} alert-dismissible fade show' role='alert'>";
        $html .= $alerta['mensaje'];
        $html .= "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
        $html .= '</div>';
        return $html;
    }
}
