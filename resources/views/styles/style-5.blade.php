<div class="home-grid-wrapper style-5">
    <div class="container">
        @if($grid->name)
            <h2 class="home-grid-title text-center">{{ $grid->name }}</h2>
        @endif
        
        @if($grid->description)
            <div class="home-grid-description text-center">
                {!! $grid->description !!}
            </div>
        @endif
        
        <div class="five-grid-container">
            @php
                // Make sure we have items
                $itemsCount = count($items);
                
                // Determine the positions of grid items (up to 5)
                $positions = [];
                for ($i = 0; $i < min(5, $itemsCount); $i++) {
                    $positions[] = $items[$i];
                }
                
                // Add empty positions if needed
                while (count($positions) < 5) {
                    $positions[] = null;
                }
                
                // Position classes
                $positionClasses = [
                    'grid-position-1', // Large feature position
                    'grid-position-2', // Top right
                    'grid-position-3', // Bottom right
                    'grid-position-4', // Bottom left
                    'grid-position-5', // Middle left
                ];
            @endphp
            
            @foreach($positions as $index => $item)
                @if($item)
                    <div class="grid-item {{ $positionClasses[$index] }}">
                        <div class="grid-item-inner" style="{{ $item->bg_color ? 'background-color: ' . $item->bg_color . ';' : '' }}">
                            @if($item->image)
                                <div class="grid-item-image">
                                    @if($item->link && !($item->button_text && $item->link))
                                        <a href="{{ $item->link }}" class="image-link">
                                    @endif
                                    
                                    @include('plugins/home-grid::includes.image', ['item' => $item, 'attributes' => ['class' => 'img-fluid', 'alt' => $item->title]])
                                    
                                    @if($item->link && !($item->button_text && $item->link))
                                        </a>
                                    @endif
                                </div>
                            @endif
                            
                            <div class="grid-item-overlay">
                                <div class="grid-item-content">
                                    @if($item->icon)
                                        <div class="grid-item-icon">
                                            <i class="{{ $item->icon }}"></i>
                                        </div>
                                    @endif
                                    
                                    @if($item->title)
                                        <h3 class="grid-item-title">{{ $item->title }}</h3>
                                    @endif
                                    
                                    @if($item->subtitle)
                                        <h4 class="grid-item-subtitle">{{ $item->subtitle }}</h4>
                                    @endif
                                    
                                    @if($item->description)
                                        <div class="grid-item-description">
                                            {!! $item->description !!}
                                        </div>
                                    @endif
                                    
                                    @if($item->button_text && $item->link)
                                        <div class="grid-item-button">
                                            <a href="{{ $item->link }}" 
                                               class="btn btn-{{ $item->button_type ?: 'light' }}"
                                               style="{{ $item->button_color ? 'background-color: ' . $item->button_color . ';' : '' }}">
                                                {{ $item->button_text }}
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="grid-item {{ $positionClasses[$index] }} empty-item">
                        <div class="grid-item-inner"></div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>