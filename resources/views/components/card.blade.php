@props([
    'title' => '',
    'icon' => '',
    'color' => 'primary',
    'headerActions' => '',
    'bodyClass' => ''
])

<div class="card">
    @if($title || $headerActions || $icon)
    <div class="card-header {{ isset($headerClass) ? $headerClass : 'd-flex justify-content-between align-items-center' }}">
        <div class="d-flex align-items-center">
            @if($icon)
            <div class="avatar avatar-sm me-3">
                <span class="avatar-initial bg-label-{{ $color }} rounded">
                    <i class="{{ $icon }}"></i>
                </span>
            </div>
            @endif
            @if($title)
            <h5 class="card-title mb-0">{{ $title }}</h5>
            @endif
        </div>
        @if($headerActions)
        <div>
            {{ $headerActions }}
        </div>
        @endif
    </div>
    @endif
    
    <div class="card-body {{ $bodyClass }}">
        {{ $slot }}
    </div>
</div>
