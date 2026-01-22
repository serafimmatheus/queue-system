<?php

if(!function_exists('showValidationErrors')) {
    function showValidationErrors($fieldName, $validationErrors) {
        if ($validationErrors->has($fieldName)) {
            return '<div class="text-sm italic text-red-500">' . $validationErrors->first($fieldName) . '</div>';
        }
        return '';
    }
}

if(!function_exists('getFormattedTicketNumber')) {
    function getFormattedTicketNumber($ticketNumber, $prefix = null, $totalDigits = 3) {
        return $prefix . str_pad($ticketNumber, $totalDigits, '0', STR_PAD_LEFT);
    }
}

if(!function_exists('getTicketStatus')) {
    function getTicketStatus($status) {
        switch ($status) {
            case 'waiting':
                return '<span class="text-yellow-500">Aguardando</span>';
            case 'called':
                return '<span class="text-green-500">Chamado</span>';
            case 'not_attended':
                return '<span class="text-red-500">Não atendido</span>';
            case 'dismissed':
                return '<span class="text-gray-500">Descartado</span>';
            default:
                return '<span class="text-gray-500">Pendente</span>';
        }
    }
}

if(!function_exists('getQueueStatus')) {
    function getQueueStatus($status) {
        $icons = [
            'active' => '<i class="fa fa-check text-green-500" title="Ativo"></i>',
            'inactive' => '<i class="fa fa-times text-red-500" title="Inativo"></i>',
            'done' => '<i class="fa fa-check-circle text-blue-500" title="Finalizado"></i>',
            'default' => '<i class="fa fa-question-circle text-gray-500" title="Pendente"></i>',
        ];

        return $icons[$status] ?? $icons['default'];
    }
}

if(!function_exists('getQueueStatusText')) {
    function getQueueStatusText($status) {
        $texts = [
            'active' => 'Ativo',
            'inactive' => 'Inativo',
            'done' => 'Finalizado',
            'default' => 'Pendente',
        ];

        return $texts[$status] ?? $texts['default'];
    }
}