<?php
/*
 * [hx_election name="foo" counted="1" total="10" seats="20"]
 * [hx_result name="bar" percentage="5" seats="1" color="#000000"]
 * [/hx_election]
 */
function hx_election($atts, $content)
{
    $a = shortcode_atts(
        array(
            'name' => 'Wingene',
            'counted' => 0,
            'total' => 1,
            'seats' => 10
        ),
        $atts
    );
    //https://bl.ocks.org/mbostock/3887235
    $data = do_shortcode($content);
    $id = uniqid();
    $graph = '
<svg width="500" height="500" id="'.$id.'"></svg>
<script type="text/javascript" src="https://d3js.org/d3.v4.min.js"></script>
<script type="text/javascript">
let colors = [];
let src_data = [];
</script>
';
    $graph = $graph.$data;
    $graph = $graph . '
<script type="text/javascript">
console.log(colors);
console.log(src_data);
graph("svg", src_data, colors);
</script>
';
    return $graph;
}

function hx_result($atts)
{
    $a = shortcode_atts(
        array(
            'name' => 'Lijst van de Burgemeester',
            'percentage' => 100,
            'seats' => 10,
            'color' => '#000000'
        ),
        $atts
    );

    $graph = '<script type="text/javascript">
src_data.push(["'.$a['name'].'", '.$a['percentage'].']);
colors.push("'.$a['color'].'");
</script>';

    return $graph;
}