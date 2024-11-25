<aside class="left-sidebar" data-sidebarbg="skin6" style="background-color:  rgba(0, 76, 255, 0.56)">

    <div class="scroll-sidebar" data-sidebarbg="skin6">

        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item "> <a class="sidebar-link sidebar-link" href="{{ route('consult.dashboard') }}"
                        aria-expanded="false"><i data-feather="home" class="feather-icon"></i>
                        <span>Dashboard</span></a></li>
                <li class="list-divider"></li>
                
                <li class="sidebar-item">
                    <a class="sidebar-link font-weight-medium" href="{{ route('consult.Adjusted') }}" aria-expanded="false"> <i data-feather="sliders" class="feather-icon"></i>
                        <span>Actions ajustées</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link font-weight-medium" href="{{ route('consult.liaison') }}" aria-expanded="false">
                        <span>Déclinaison-Structures</span>
                    </a>
                </li>

                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="font-weight-medium">C O P</span></li>
                
                <li class="sidebar-item">
                    <a class="sidebar-link font-weight-medium" href="{{ route('consult.cop') }}" aria-expanded="false"><i class="fa-solid fa-file-contract fa-lg pe-2"></i>
                        <span>COP</span>
                    </a>
                </li>

            </ul>
        </nav>

    </div>

</aside>