<div {{ $attributes->merge(['class'=>'card card-outline card-primary elevation-4']) }}>
    @if (!is_null($header))
        <div class="card-header">
            {{ $header }}
        </div>
    @endif
    <div class="card-body">
        {{ $body }}
    </div>
    @if (!is_null($footer))
        <div class="card-footer">
            {{ $footer }}
        </div>
    @endif
</div>
