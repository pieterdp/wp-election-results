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
    $graph = '
    <div class="container">
    <div class="row">
    <div class="col-sm-12">
    <figure class="figure mb-4 col-sm-12">
    <figcaption class="figure-caption text-left" id="caption_'.$id.'"></figcaption>
    <svg width="500" height="250" id="graph_' . $id . '" class="figure-img img-fluid ml-auto mr-auto"></svg>
    <figcaption class="figure-caption text-right mt-2" id="switch_graph_'.$id.'"><div class="btn-group" role="group" aria-label="Verander resultaatweergave"><button type="button" data-hx-graph-type="seats" class="btn btn-light btn-sm">Zetelverdeling</button><button type="button" data-hx-graph-type="results" class="btn btn-light btn-sm">Resultaten</button></div></figcaption>
</figure>
    
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
let colors_' . $id . ' = [];
let results_' . $id . ' = [];
let seats_' . $id . ' = [];
let table_data_' . $id . ' = [];
let table_' . $id . ' = $("#table_' . $id . '");
</script>
';
    $graph = $graph . $data;
    $graph = $graph . '
<script type="text/javascript">';
    if ($a['counted'] == $a['total']) {
        // Show seats if a complete result
        $graph = $graph . '
graph("#graph_' . $id . '", seats_' . $id . ', results_' . $id . ', colors_' . $id . ', "seats", "'.$id.'");';
    } else {
        $graph = $graph . '
graph("#graph_' . $id . '", seats_' . $id . ', results_' . $id . ', colors_' . $id . ', "results", "'.$id.'");';
    }
    $graph = $graph . '
table_' . $id . '.DataTable({
    data: table_data_' . $id . '
});
</script>
';
    return $graph;
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
