<aside class="left-sidebar" data-sidebarbg="skin6" style="background-color:  rgba(0, 76, 255, 0.56);">

    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <nav class="sidebar-nav">


            <ul id="sidebarnav">
                <li class="sidebar-item font-weight-medium"> <a class="sidebar-link" href="{{ route('consult.dashboard') }}"
                        aria-expanded="false"><i data-feather="home" class="feather-icon"></i>
                        <span>Dashboard</span></a>
                </li>

                <li class="list-divider"></li>

                <li class="sidebar-item">
                    <a class="sidebar-link font-weight-medium" href="{{ route('directeur.proposition') }}" aria-expanded="false"><i class="fa-solid fa-wand-magic-sparkles me-2"></i>
                        @if (auth()->user()->id_dir && auth()->user()->id_dir >= 1 && auth()->user()->id_dir <= 14)
                            <span>Proposer Des Actions</span>
                        @else
                            <span>Actions Ajustées</span>
                        @endif
                    </a>
                </li>

                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="font-weight-medium">C O P</span></li>
                @if (auth()->user()->id_dir && auth()->user()->id_dir >= 1 && auth()->user()->id_dir <= 14)
                @else
                    
                    <li class="sidebar-item">
                        <a class="sidebar-link font-weight-medium" href="{{ route('directeur.cop') }}" aria-expanded="false">
                            <i class="fa-solid fa-file-contract fa-lg pe-2"></i>
                            <span class="font-weight-medium">Actions COP</span>
                        </a>
                    </li>

                @endif

                @php
                    $found = false;
                @endphp

                @foreach ($NumDenom as $item)
                    @if (auth()->user()->id_dir == $item->id_dc)
                        <li class="sidebar-item">
                            <a class="sidebar-link font-weight-medium" href="{{ route('directeur.copAdd') }}" aria-expanded="false">
                                <i class="fa-solid fa-file-circle-plus fa-lg me-1"></i>
                                <span>COP</span>
                            </a>
                        </li>
                        @php
                            $found = true;
                        @endphp
                    @endif

                    @if ($found)
                        @break
                    @endif
                @endforeach

                @if (auth()->user()->id_dir && auth()->user()->id_dir == '9')
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('directeur.pageCalculate') }}"
                            aria-expanded="false"><i class="fa-solid fa-calculator me-2 fa-lg"></i>
                            <span class="font-weight-medium">Les calculs</span>
                        </a>
                    </li>
                @endif
                

            </ul>



        </nav>

    </div>
</aside>