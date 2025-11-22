<x-mail::message>
{{-- Greeting --}}
@if (! empty($greeting))
    # {{ $greeting }}
@else
    @if ($level === 'error')
        # @lang('Ops!')
    @else
        # @lang('Olá!')
    @endif
@endif

{{-- Intro Lines --}}
{{-- @foreach ($introLines as $line)
{{ $line }}
@endforeach --}}

{{-- Outro Lines --}}
{{-- @foreach ($outroLines as $line)
{{ $line }}
@endforeach --}}

@lang('Você está recebendo este e-mail porque nos enviou uma solicitação de redefinição de senha para sua conta All Presets.')

<br>

@lang('Clique no botão abaixo para redefinir sua senha:')

<br>

{{-- Action Button --}}
@isset($actionText)
<?php
    $color = match ($level) {
        'success', 'error' => $level,
        default => 'primary',
    };
?>
<x-mail::button :url="$actionUrl" :color="$color">
{{ $actionText }}
</x-mail::button>
@endisset

<br>

@lang('Este link expirará em 60 minutos.')

<br>

@lang('Se você não solicitou uma redefinição de senha, nenhuma ação adicional é necessária.')


{{-- Salutation --}}
@if (! empty($salutation))
    {{ $salutation }}
@else
    @lang('Atenciosamente, All Presets.')
@endif

{{-- Subcopy --}}
@isset($actionText)
<x-slot:subcopy>
@lang(
    "Se você estiver com dificuldades para clicar no botão \":actionText\" , copie e cole a URL abaixo\n".
    'no seu navegador web:',
    [
        'actionText' => $actionText,
    ]
) <span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>
</x-slot:subcopy>
@endisset
</x-mail::message>
