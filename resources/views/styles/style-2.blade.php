<div class="home-grid-wrapper style-2">
    <div class="">
       
        
        <div class="row grid-masonry">
            @php
                $colClasses = ['col-md-6', 'col-md-6', 'col-md-4', 'col-md-4', 'col-md-4', 'col-md-6', 'col-md-6'];
                $heightClasses = ['grid-height-1', 'grid-height-2', 'grid-height-1', 'grid-height-2', 'grid-height-1', 'grid-height-1', 'grid-height-2'];
            @endphp
            
            @foreach($items as $index => $item)
                @php
                    $colClass = $colClasses[$index % count($colClasses)];
                    $heightClass = $heightClasses[$index % count($heightClasses)];
                @endphp
                
                <div class="{{ $colClass }} mb-4">
                    <div class="card h-100 {{ $heightClass }}" style="{{ $item->bg_color ? 'background-color: ' . $item->bg_color . ';' : '' }}">
                        @if($item->title || $item->subtitle || $item->description || ($item->button_text && $item->link))
                            <div class="card-body">
                                @if($item->icon)
                                    <div class="card-icon text-center mb-3">
                                        <i class="{{ $item->icon }} fa-2x"></i>
                                    </div>
                                @endif
                                
                                @if($item->title)
                                    <h3 class="card-title">{{ $item->title }}</h3>
                                @endif
                                
                                @if($item->subtitle)
                                    <h4 class="card-subtitle mb-2 text-muted">{{ $item->subtitle }}</h4>
                                @endif
                                
                                @if($item->description)
                                    <div class="card-text">
                                        {!! $item->description !!}
                                    </div>
                                @endif
                                
                                @if($item->button_text && $item->link)
                                    <div class="grid-item-button mt-3">
                                        <a href="{{ $item->link }}" 
                                           class="btn btn-{{ $item->button_type ?: 'primary' }}"
                                           style="{{ $item->button_color ? 'background-color: ' . $item->button_color . ';' : '' }}">
                                            {{ $item->button_text }}
                                        </a>
                                    </div>
                                @endif
                            </div>
                        @endif
                        
                        @if($item->image)
                            <div class="card-img-overlay p-0">
                                @if($item->link && !($item->button_text && $item->link))
                                    <a href="{{ $item->link }}" class="d-block h-100">
                                @endif
                                
                                @include('plugins/home-grid::includes.image', ['item' => $item, 'attributes' => ['class' => 'img-fluid h-100 w-100 object-fit-cover', 'alt' => $item->title]])
                                
                                @if($item->link && !($item->button_text && $item->link))
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>