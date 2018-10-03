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
    <div class="container">
    <div class="row">
    <div class="col-sm-12">
    <svg width="500" height="400" id="graph_' . $id . '"></svg>
<table id="table_' . $id . '">
<thead>
<tr>
<th scope="col">Partij</th>
<th scope="col">Resultaat</th>
<th scope="col">Zetels</th>
</tr>
</thead>
<tbody></tbody>
</table>
</div>
</div>
</div>
<script type="text/javascript">
let colors = [];
let src_data = [];
let table_data = [];
let table = $("#table_' . $id . '");
</script>
';
    $graph = $graph . $data;
    $graph = $graph . '
<script type="text/javascript">
graph("#graph_' . $id . '", src_data, colors);
table.DataTable({
    data: table_data
});
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
src_data.push(["' . $a['name'] . '", ' . $a['percentage'] . ']);
colors.push("' . $a['color'] . '");
table_data.push(["' . $a['name'] . '", ' . $a['percentage'] . ', '.$a['seats'].', "'.$a['color'].'"]);
</script>';

    return $graph;
}