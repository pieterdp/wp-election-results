<?php
/*
 * [hx_election_auto name="Wingene" id="wingene_2018" vl_id="37018" vl_year="2018" vl_api_version="2018"]
 */

include_once(plugin_dir_path(__FILE__).'templates/graph.php');
function hx_election_auto($atts) {
    $a = shortcode_atts(
        array(
            'name' => 'Wingene',
            'id' => 'wingene_2018',
            'vl_id' => '37018',
            'vl_year' => 2018,
            'vl_api_version' => 2018
        ),
        $atts
    );
    $api_versions = array(
        2018 => 'https://www.vlaanderenkiest.be/verkiezingen'.$a['vl_year'].'/api/'.$a['vl_year'].'/lv/gemeente/'.$a['vl_id'].'/',
        2012 => 'https://www.vlaanderenkiest.be/verkiezingen'.$a['vl_year'].'/'.$a['vl_year'].'/gemeente/'.$a['vl_id'].'/'
    );
    $id = preg_replace('[^A-Z0-9a-z_]', '_', $a['id']);
    $lists = get_lists($api_versions[$a['vl_api_version']]);
    $results = get_results($api_versions[$a['vl_api_version']], $a['vl_id'], $lists);
    $data = '<script type="text/javascript">';
    $data = $data.'
results_'.$id.' = '.ugly_php_to_js_array($results['results'], 'results').'
seats_'.$id.' = '.ugly_php_to_js_array($results['results'], 'seats').'
colors_'.$id.' = '.ugly_php_to_js_array($results['results'], 'colors').'
table_data_' . $id . ' = '.ugly_php_to_js_array($results['results'], 'table_data').'
';
    $data = $data.'</script>';
    return graph($id, $results['counted'], $results['total'], $data);
}

function ugly_php_to_js_array($results, $format_request) {
    $formatted_a = array();
    foreach ($results as $id => $result) {
        $formatted_a[] = $result['formatted'][$format_request];
    }
    $formatted_results = implode(',', $formatted_a);
    return '['.$formatted_results.'];';
}

function get_results($api, $vl_id, $lists) {
    $results = array();
    $total = 0;
    $r = wp_remote_get($api.'entiteitUitslag.json');
    if (is_wp_error($r)) {
        echo 'Could not fetch results: '.$r->get_error_message();
        return $results;
    }
    $results_raw = json_decode($r['body'], true);
    $results_raw = $results_raw['G'][$vl_id];
    foreach ($results_raw['us'] as $id => $result_raw) {
        $total = $total + $result_raw['sc'];
    }
    foreach ($lists as $list_id => $list) {
        $result = array(
            'name' => $list['name'],
            'color' => $list['color'],
            'results' => array(
                'count' => $results_raw['us'][$list_id]['sc'],
                'seats' => $results_raw['us'][$list_id]['zs']
            ),
        );
        if ($total > 0) {
            $result['results']['percentage'] =  round($results_raw['us'][$list_id]['sc'] / $total * 100, 2);
        } else {
            $result['results']['percentage'] = 0;
        }
        $result['formatted'] = array(
            'results' => '["'.$result['name'].'", '.$result['results']['percentage'].']',
            'seats' => '["'.$result['name'].'", '.$result['results']['seats'].']',
            'colors' => '["'.$result['color'].'"]',
            'table_data' => '["'.$result['name'].'", '.$result['results']['percentage'].', '.$result['results']['seats'].', "'.$result['color'].'"]'
        );
        $results[$list_id] = $result;
    }
    $counted_raw = explode('/', $results_raw['gb']);
    return array(
        'counted' => $counted_raw[0],
        'total' => $counted_raw[1],
        'results' => $results
    );
}

function get_lists($api) {
    $lists = array();
    $no_colors = array('#dcdcdc', '#d3d3d3', '#c0c0c0', '#a9a9a9', '#808080', '#696969', '#778899', '#708090', '#2f4f4f');
    $r = wp_remote_get($api.'entiteitLijsten.json');
    if (is_wp_error($r)) {
        echo 'Could not fetch lists: '.$r->get_error_message();
        return $lists;
    }
    $lists_raw = json_decode($r['body'], true);
    foreach ($lists_raw['G'] as $id => $list) {
        if (!array_key_exists('kl', $list) || $list['kl'] === '') {
            $color = array_pop($no_colors);
        } else {
            $color = $list['kl'];
        }
        $lists[$id] = array(
            'name' => $list['nm'],
            'color' => $color
        );
    }
    return $lists;
}
