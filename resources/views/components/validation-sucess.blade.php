<div>
    @props(['mensagem'])

    @if($mensagem)
        <div {{ $attributes }}>
            <div class="font-medium text-green-600">{{ __('Sucesso!') }}</div>

            <p class="mt-3 text-sm text-green-600">
                {{ $mensagem }}
            </p>
        </div>
    @endif
</div>