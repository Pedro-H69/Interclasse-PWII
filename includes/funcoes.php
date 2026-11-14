<?php
/**
 * 
 * @param string $tipo 
 * @param string $texto 
 */
function setMensagem(string $tipo, string $texto): void {
    $_SESSION['mensagem'] = [
        'tipo' => $tipo, 
        'texto' => $texto
    ];
}

function exibirMensagem(): void {
    if (!empty($_SESSION['mensagem'])) {
        $m = $_SESSION['mensagem'];
        
        if ($m['tipo'] === 'sucesso') {
            $bg = '#d4edda';
            $color = '#32b350';
            $border = '#c3e6cb';
        } else {
            $bg = '#f8d7da';
            $color = '#c02d3c';
            $border = '#f5c6cb';
        }

        echo "<div style='padding: 12px 15px; margin-bottom: 20px; border-radius: 6px; background-color: {$bg}; color: {$color}; border: 1px solid {$border}; font-size: 14px;'>";
        echo htmlspecialchars($m['texto'], ENT_QUOTES, 'UTF-8');
        echo "</div>";

        unset($_SESSION['mensagem']);
    }
}

/**
 * @param string $dado O dado bruto enviado pelo usuário
 * @return string O dado limpo e seguro
 */
function limpar(string $dado): string {
    return htmlspecialchars(trim($dado), ENT_QUOTES, 'UTF-8');
}