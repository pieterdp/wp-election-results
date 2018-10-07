<?php

function graph($id, $counted, $total, $data = null) {
    $graph = '
    <div class="container">
    <div class="row">
    <div class="col-sm-12">
    <figure class="figure mb-4 col-sm-12">
    <figcaption class="figure-caption text-left" id="caption_'.$id.'"></figcaption>
    <svg width="500" height="250" id="graph_' . $id . '" class="figure-img img-fluid ml-auto mr-auto"></svg>
    <figcaption class="figure-caption text-right mt-2" id="switch_graph_'.$id.'"><div class="btn-group" role="group" aria-label="Verander resultaatweergave"><button type="button" data-hx-graph-type="results" class="btn btn-light btn-sm">Resultaten</button><button type="button" data-hx-graph-type="seats" class="btn btn-light btn-sm">Zetelverdeling</button></div></figcaption>
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
    $graph = $graph . '
graph("#graph_' . $id . '", seats_' . $id . ', results_' . $id . ', colors_' . $id . ', "results", "'.$id.'", '.$counted.', '.$total.');';
    $graph = $graph . '
data_table("#table_' . $id . '", table_data_' . $id . ');
</script>
';
    return $graph;
}
