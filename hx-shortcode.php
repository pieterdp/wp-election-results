<?php
/*
 * [hx_election name="foo" counted="1" total="10" seats="20"]
 * [hx_result name="bar" percentage="5" seats="1" color="#000000"]
 * [/hx_election]
 */

include_once(plugin_dir_path(__FILE__).'templates/graph.php');
function hx_election($atts, $content)
{
    $a = shortcode_atts(
        array(
            'id' => 'Wingene_2018',
            'name' => 'Wingene',
            'counted' => 0,
            'total' => 1,
            'seats' => 10
        ),
        $atts
    );
    //https://bl.ocks.org/mbostock/3887235
    $data = do_shortcode($content);
    $id = preg_replace('[^A-Z0-9a-z_]', '_', $a['id']);
    return graph($id, $a['counted'], $a['total'], $data);
}

function hx_result($atts)
{
    $a = shortcode_atts(
        array(
            'id' => 'Wingene_2018',
            'name' => 'Lijst van de Burgemeester',
            'percentage' => 100,
            'seats' => 10,
            'color' => '#000000'
        ),
        $atts
    );
    $id = preg_replace('[^A-Z0-9a-z_]', '_', $a['id']);
    $graph = '<script type="text/javascript">';
    $graph = $graph.'
results_' . $id . '.push(["' . $a['name'] . '", ' . $a['percentage'] . ']);
seats_' . $id . '.push(["' . $a['name'] . '", ' . $a['seats'] . ']);
colors_' . $id . '.push("' . $a['color'] . '");
table_data_' . $id . '.push(["' . $a['name'] . '", ' . $a['percentage'] . ', ' . $a['seats'] . ', "' . $a['color'] . '"]);';
    $graph = $graph.'
</script>';

    return $graph;
}
