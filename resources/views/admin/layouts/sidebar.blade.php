<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ms-auto">
            <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            @php
            function isActive($modul)
            {
                if ($modul->url && request()->is(trim($modul->url, '/'))) {
                    return true;
                }
                if ($modul->children) {
                    foreach ($modul->children as $child) {
                        if (isActive($child)) {
                            return true;
                        }
                    }
                }
                return false;
            }
            function renderMenuItems($moduls, $level = 1)
            {
                foreach ($moduls as $modul) {
                    $urlm = route($modul->url);
                    $active = isActive($modul) ? 'mm-active' : '';
                    echo '<li class="' . $active . '">';
                    echo '<a href="' .  ($urlm ?? '#') . '" class="' . $active . '">';
                    echo '<i class="metismenu-icon ' . $modul->icon . '"></i>';
                    echo $modul->title;

                    if ($modul->children->isNotEmpty() && $level < 3) {
                        echo '<i class="metismenu-state-icon bi bi-chevron-down caret-left"></i>';
                    }
                    echo '</a>';
                    if ($modul->children->isNotEmpty() && $level < 3) {
                        echo '<ul>';
                        renderMenuItems($modul->children, $level + 1);
                        echo '</ul>';
                    }
                    echo '</li>';
                }
            }
            @endphp
            <ul class="vertical-nav-menu">
                <li class="app-sidebar__heading">Menu Dashboard</li>
                @php renderMenuItems($dashboardModuls->whereNull('parent_id')); @endphp
            </ul>
        </div>
    </div>
</div>