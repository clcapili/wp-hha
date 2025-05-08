<?php
// header tabs
// desktop
function columnDescriptiveLinksDesktop($layout) {
    $output = '
        <div class="col-lg col-xl-4">
            <ul class="list-unstyled submenu-section with-icon">';

            if (!empty($links = $layout['links'])) {
                foreach ($links as $link) {
                    $output .= '<li class="d-flex flex-column">';
                    $output .= '<a href="'.$link['link']['url'].'" class="d-flex align-items-center">'.$link['link']['title'].'<i class="icon icon-arrow-right"></i></a>';
                    $output .= '<small>'.$link['description'].'</small>';
                    $output .= '</li>';
                }
            }

    $output .= '
            </ul>
        </div>';

    return $output;
}

function columnLinkListDesktop($layout) {
    $output = '
        <div class="adaptive-col">';

    $output .= '
            <ul class="list-unstyled submenu-section">
                <small class="submenu-label">'. (!empty($layout['label']) ? $layout['label'] : '') .'</small>';
            if (!empty($links = $layout['links'])) {
                foreach ($links as $link) {
                    $output .= '<li>'.get_link_tag($link['link'], '').'</li>';
                }
            }

    $output .= '
            </ul>
        </div>';

    return $output;
}

// mobile
function columnDescriptiveLinksMobile($layout) {
    $output = '
        <div class="col-md-4">
            <ul class="list-unstyled submenu-section">';

            if (!empty($links = $layout['links'])) {
                foreach ($links as $link) {
                    $output .= '<li>';
                    $output .= '<a href="'.$link['link']['url'].'">'.$link['link']['title'].'<i class="icon icon-arrow-right"></i></a>';
                    $output .= '<small>'.$link['description'].'</small>';
                    $output .= '</li>';
                }
            }

    $output .= '
            </ul>
        </div>';

    return $output;
}

function columnLinkListMobile($layout) {
    $output = '
        <div class="col-md-4 submenu-section">';

    if (!empty($links = $layout['links'])) {
        $output .= '
            <ul class="list-unstyled">
                <small class="submenu-label">'. (!empty($layout['label']) ? $layout['label'] : '') .'</small>';
        
        foreach ($links as $link) {
            $output .= '<li>'.get_link_tag($link['link'], '').'</li>';
        }
    
        $output .= '</ul>';
    }

    $output .= '
        </div>';

    return $output;
}
// header tabs end