<div class="home-grid-wrapper style-4">
    <div class="container-fluid p-0">
        
        
        <div class="fullpage-grid">
            <div class="row g-0">
                @php
                    // Make sure we have items
                    $itemsCount = count($items);
                    
                    // Setup placeholders for each position
                    $positions = [
                        'col1' => null,  // Full height image
                        'col2-top' => null,  // Top image in column 2
                        'col2-bottom' => null,  // Bottom image in column 2
                        'col3-top' => null,  // Top small image in column 3
                        'col3-bottom' => null,  // Bottom larger image in column 3
                    ];
                    
                    // Assign items to positions
                    if ($itemsCount > 0) $positions['col1'] = $items[0];
                    if ($itemsCount > 1) $positions['col2-top'] = $items[1];
                    if ($itemsCount > 2) $positions['col2-bottom'] = $items[2];
                    if ($itemsCount > 3) $positions['col3-top'] = $items[3];
                    if ($itemsCount > 4) $positions['col3-bottom'] = $items[4];
                @endphp
                
                <!-- Column 1: Full height image -->
                <div class="col-md-4">
                    @if($positions['col1'])
                        <div class="grid-item full-height" style="{{ $positions['col1']->bg_color ? 'background-color: ' . $positions['col1']->bg_color . ';' : '' }}">
                            <div class="grid-content position-relative">
                                @if($positions['col1']->title || $positions['col1']->subtitle || $positions['col1']->description || ($positions['col1']->button_text && $positions['col1']->link))
                                    <div class="grid-info position-absolute top-0 start-0 w-100 p-4 z-1">
                                        @if($positions['col1']->icon)
                                            <div class="grid-icon mb-2">
                                                <i class="{{ $positions['col1']->icon }} text-white"></i>
                                            </div>
                                        @endif
                                        
                                      
                                        
                                        @if($positions['col1']->subtitle)
                                            <h4 class="grid-subtitle text-white-50 mb-2">{{ $positions['col1']->subtitle }}</h4>
                                        @endif
                                        
                                        @if($positions['col1']->description)
                                            <div class="grid-desc text-white-50 mb-3">
                                                {!! $positions['col1']->description !!}
                                            </div>
                                        @endif
                                        
                                        @if($positions['col1']->button_text && $positions['col1']->link)
                                            <a href="{{ $positions['col1']->link }}" 
                                               class="btn btn-{{ $positions['col1']->button_type ?: 'light' }}"
                                               style="{{ $positions['col1']->button_color ? 'background-color: ' . $positions['col1']->button_color . ';' : '' }}">
                                                {{ $positions['col1']->button_text }}
                                            </a>
                                        @endif
                                    </div>
                                @endif
                                
                                <div class="grid-item-overlay position-absolute w-100 h-100" 
                                     style="{{ $positions['col1']->bg_color ? 'background-color: ' . $positions['col1']->bg_color . ';' : 'background: linear-gradient(to bottom, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.3) 50%, rgba(0,0,0,0.1) 100%);' }}">
                                </div>
                                
                                @if($positions['col1']->image)
                                    @if($positions['col1']->link && !($positions['col1']->button_text && $positions['col1']->link))
                                        <a href="{{ $positions['col1']->link }}" class="d-block h-100">
                                    @endif
                                    
                                    @include('plugins/home-grid::includes.image', ['item' => $positions['col1'], 'attributes' => ['class' => 'img-fluid w-100 h-100 object-fit-cover', 'alt' => $positions['col1']->title]])
                                    
                                    @if($positions['col1']->link && !($positions['col1']->button_text && $positions['col1']->link))
                                        </a>
                                    @endif
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
                
                <!-- Column 2: Two equal sized images -->
                <div class="col-md-4">
                    @if($positions['col2-top'])
                        <div class="grid-item half-height" style="{{ $positions['col2-top']->bg_color ? 'background-color: ' . $positions['col2-top']->bg_color . ';' : '' }}">
                            <div class="grid-content position-relative">
                                @if($positions['col2-top']->title || $positions['col2-top']->subtitle || $positions['col2-top']->description || ($positions['col2-top']->button_text && $positions['col2-top']->link))
                                    <div class="grid-info position-absolute top-0 start-0 w-100 p-4 z-1">
                                        @if($positions['col2-top']->icon)
                                            <div class="grid-icon mb-2">
                                                <i class="{{ $positions['col2-top']->icon }} text-white"></i>
                                            </div>
                                        @endif
                                        
                                  
                                        
                                        @if($positions['col2-top']->subtitle)
                                            <h4 class="grid-subtitle text-white-50 mb-2">{{ $positions['col2-top']->subtitle }}</h4>
                                        @endif
                                        
                                        @if($positions['col2-top']->description)
                                            <div class="grid-desc text-white-50 mb-3">
                                                {!! $positions['col2-top']->description !!}
                                            </div>
                                        @endif
                                        
                                        @if($positions['col2-top']->button_text && $positions['col2-top']->link)
                                            <a href="{{ $positions['col2-top']->link }}" 
                                               class="btn btn-{{ $positions['col2-top']->button_type ?: 'light' }}"
                                               style="{{ $positions['col2-top']->button_color ? 'background-color: ' . $positions['col2-top']->button_color . ';' : '' }}">
                                                {{ $positions['col2-top']->button_text }}
                                            </a>
                                        @endif
                                    </div>
                                @endif
                                
                                <div class="grid-item-overlay position-absolute w-100 h-100" 
                                     style="{{ $positions['col2-top']->bg_color ? 'background-color: ' . $positions['col2-top']->bg_color . ';' : 'background: linear-gradient(to bottom, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.3) 50%, rgba(0,0,0,0.1) 100%);' }}">
                                </div>
                                
                                @if($positions['col2-top']->image)
                                    @if($positions['col2-top']->link && !($positions['col2-top']->button_text && $positions['col2-top']->link))
                                        <a href="{{ $positions['col2-top']->link }}" class="d-block h-100">
                                    @endif
                                    
                                    @include('plugins/home-grid::includes.image', ['item' => $positions['col2-top'], 'attributes' => ['class' => 'img-fluid w-100 h-100 object-fit-cover', 'alt' => $positions['col2-top']->title]])
                                    
                                    @if($positions['col2-top']->link && !($positions['col2-top']->button_text && $positions['col2-top']->link))
                                        </a>
                                    @endif
                                @endif
                            </div>
                        </div>
                    @endif
                    
                    @if($positions['col2-bottom'])
                        <div class="grid-item half-height" style="{{ $positions['col2-bottom']->bg_color ? 'background-color: ' . $positions['col2-bottom']->bg_color . ';' : '' }}">
                            <div class="grid-content position-relative">
                                @if($positions['col2-bottom']->title || $positions['col2-bottom']->subtitle || $positions['col2-bottom']->description || ($positions['col2-bottom']->button_text && $positions['col2-bottom']->link))
                                    <div class="grid-info position-absolute top-0 start-0 w-100 p-4 z-1">
                                        @if($positions['col2-bottom']->icon)
                                            <div class="grid-icon mb-2">
                                                <i class="{{ $positions['col2-bottom']->icon }} text-white"></i>
                                            </div>
                                        @endif
                                        
                                      
                                        
                                        @if($positions['col2-bottom']->subtitle)
                                            <h4 class="grid-subtitle text-white-50 mb-2">{{ $positions['col2-bottom']->subtitle }}</h4>
                                        @endif
                                        
                                        @if($positions['col2-bottom']->description)
                                            <div class="grid-desc text-white-50 mb-3">
                                                {!! $positions['col2-bottom']->description !!}
                                            </div>
                                        @endif
                                        
                                        @if($positions['col2-bottom']->button_text && $positions['col2-bottom']->link)
                                            <a href="{{ $positions['col2-bottom']->link }}" 
                                               class="btn btn-{{ $positions['col2-bottom']->button_type ?: 'light' }}"
                                               style="{{ $positions['col2-bottom']->button_color ? 'background-color: ' . $positions['col2-bottom']->button_color . ';' : '' }}">
                                                {{ $positions['col2-bottom']->button_text }}
                                            </a>
                                        @endif
                                    </div>
                                @endif
                                
                                <div class="grid-item-overlay position-absolute w-100 h-100" 
                                     style="{{ $positions['col2-bottom']->bg_color ? 'background-color: ' . $positions['col2-bottom']->bg_color . ';' : 'background: linear-gradient(to bottom, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.3) 50%, rgba(0,0,0,0.1) 100%);' }}">
                                </div>
                                
                                @if($positions['col2-bottom']->image)
                                    @if($positions['col2-bottom']->link && !($positions['col2-bottom']->button_text && $positions['col2-bottom']->link))
                                        <a href="{{ $positions['col2-bottom']->link }}" class="d-block h-100">
                                    @endif
                                    
                                    @include('plugins/home-grid::includes.image', ['item' => $positions['col2-bottom'], 'attributes' => ['class' => 'img-fluid w-100 h-100 object-fit-cover', 'alt' => $positions['col2-bottom']->title]])
                                    
                                    @if($positions['col2-bottom']->link && !($positions['col2-bottom']->button_text && $positions['col2-bottom']->link))
                                        </a>
                                    @endif
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
                
                <!-- Column 3: Small image on top, larger image below -->
                <div class="col-md-4">
                    @if($positions['col3-top'])
                        <div class="grid-item small-height" style="{{ $positions['col3-top']->bg_color ? 'background-color: ' . $positions['col3-top']->bg_color . ';' : '' }}">
                            <div class="grid-content position-relative">
                                @if($positions['col3-top']->title || $positions['col3-top']->subtitle || $positions['col3-top']->description || ($positions['col3-top']->button_text && $positions['col3-top']->link))
                                    <div class="grid-info position-absolute top-0 start-0 w-100 p-4 z-1">
                                        @if($positions['col3-top']->icon)
                                            <div class="grid-icon mb-2">
                                                <i class="{{ $positions['col3-top']->icon }} text-white"></i>
                                            </div>
                                        @endif
                                        
                                      
                                        
                                        @if($positions['col3-top']->subtitle)
                                            <h4 class="grid-subtitle text-white-50 mb-2">{{ $positions['col3-top']->subtitle }}</h4>
                                        @endif
                                        
                                        @if($positions['col3-top']->description)
                                            <div class="grid-desc text-white-50 mb-3">
                                                {!! $positions['col3-top']->description !!}
                                            </div>
                                        @endif
                                        
                                        @if($positions['col3-top']->button_text && $positions['col3-top']->link)
                                            <a href="{{ $positions['col3-top']->link }}" 
                                               class="btn btn-{{ $positions['col3-top']->button_type ?: 'light' }}"
                                               style="{{ $positions['col3-top']->button_color ? 'background-color: ' . $positions['col3-top']->button_color . ';' : '' }}">
                                                {{ $positions['col3-top']->button_text }}
                                            </a>
                                        @endif
                                    </div>
                                @endif
                                
                                <div class="grid-item-overlay position-absolute w-100 h-100" 
                                     style="{{ $positions['col3-top']->bg_color ? 'background-color: ' . $positions['col3-top']->bg_color . ';' : 'background: linear-gradient(to bottom, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.3) 50%, rgba(0,0,0,0.1) 100%);' }}">
                                </div>
                                
                                @if($positions['col3-top']->image)
                                    @if($positions['col3-top']->link && !($positions['col3-top']->button_text && $positions['col3-top']->link))
                                        <a href="{{ $positions['col3-top']->link }}" class="d-block h-100">
                                    @endif
                                    
                                    @include('plugins/home-grid::includes.image', ['item' => $positions['col3-top'], 'attributes' => ['class' => 'img-fluid w-100 h-100 object-fit-cover', 'alt' => $positions['col3-top']->title]])
                                    
                                    @if($positions['col3-top']->link && !($positions['col3-top']->button_text && $positions['col3-top']->link))
                                        </a>
                                    @endif
                                @endif
                            </div>
                        </div>
                    @endif
                    
                    @if($positions['col3-bottom'])
                        <div class="grid-item large-height" style="{{ $positions['col3-bottom']->bg_color ? 'background-color: ' . $positions['col3-bottom']->bg_color . ';' : '' }}">
                            <div class="grid-content position-relative">
                                @if($positions['col3-bottom']->title || $positions['col3-bottom']->subtitle || $positions['col3-bottom']->description || ($positions['col3-bottom']->button_text && $positions['col3-bottom']->link))
                                    <div class="grid-info position-absolute top-0 start-0 w-100 p-4 z-1">
                                        @if($positions['col3-bottom']->icon)
                                            <div class="grid-icon mb-2">
                                                <i class="{{ $positions['col3-bottom']->icon }} text-white"></i>
                                            </div>
                                        @endif
                                        
                                        @if($positions['col3-bottom']->title)
                                            <h3 class="grid-title text-white mb-2">{{ $positions['col3-bottom']->title }}</h3>
                                        @endif
                                        
                                        @if($positions['col3-bottom']->subtitle)
                                            <h4 class="grid-subtitle text-white-50 mb-2">{{ $positions['col3-bottom']->subtitle }}</h4>
                                        @endif
                                        
                                        @if($positions['col3-bottom']->description)
                                            <div class="grid-desc text-white-50 mb-3">
                                                {!! $positions['col3-bottom']->description !!}
                                            </div>
                                        @endif
                                        
                                        @if($positions['col3-bottom']->button_text && $positions['col3-bottom']->link)
                                            <a href="{{ $positions['col3-bottom']->link }}" 
                                               class="btn btn-{{ $positions['col3-bottom']->button_type ?: 'light' }}"
                                               style="{{ $positions['col3-bottom']->button_color ? 'background-color: ' . $positions['col3-bottom']->button_color . ';' : '' }}">
                                                {{ $positions['col3-bottom']->button_text }}
                                            </a>
                                        @endif
                                    </div>
                                @endif
                                
                                <div class="grid-item-overlay position-absolute w-100 h-100" 
                                     style="{{ $positions['col3-bottom']->bg_color ? 'background-color: ' . $positions['col3-bottom']->bg_color . ';' : 'background: linear-gradient(to bottom, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.3) 50%, rgba(0,0,0,0.1) 100%);' }}">
                                </div>
                                
                                @if($positions['col3-bottom']->image)
                                    @if($positions['col3-bottom']->link && !($positions['col3-bottom']->button_text && $positions['col3-bottom']->link))
                                        <a href="{{ $positions['col3-bottom']->link }}" class="d-block h-100">
                                    @endif
                                    
                                    @include('plugins/home-grid::includes.image', ['item' => $positions['col3-bottom'], 'attributes' => ['class' => 'img-fluid w-100 h-100 object-fit-cover', 'alt' => $positions['col3-bottom']->title]])
                                    
                                    @if($positions['col3-bottom']->link && !($positions['col3-bottom']->button_text && $positions['col3-bottom']->link))
                                        </a>
                                    @endif
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>