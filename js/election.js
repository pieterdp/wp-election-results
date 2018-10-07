function graph(selector, src_data, colors, graph_type, id) {
    let svg = d3.select(selector),
        width = +svg.attr('width'),
        height = +svg.attr('height'),
        radius = Math.min(width, height) / 2,
        g = svg.append('g').attr('transform', 'translate(' + width / 2 + ',' + height / 1.25 + ')');

    let color = d3.scaleOrdinal(colors);

    let pie = d3.pie()
        .sort(null)
        .startAngle(0.5 * Math.PI * -1)
        .endAngle(0.5 * Math.PI)
        .value(function (d) {
            return d[1];
        });

    let path = d3.arc()
        .outerRadius(radius - 10)
        .innerRadius(0);

    let label = d3.arc()
        .outerRadius(radius - 40)
        .innerRadius(radius - 40);

    let arc = g.selectAll('.arc')
        .data(pie(src_data))
        .enter().append('g')
        .attr('class', 'arc');

    arc.append('path')
        .attr('d', path)
        .attr('fill', function (d) {
            return color(d.data[0]);
        });

    /*arc.append('text')
        .attr('transform', function(d) { return 'translate(' + label.centroid(d) + ')'; })
        .attr('dy', '0.35em')
        .text(function(d) { return d.data[0]; });*/

    let legend = $('#caption_' + id);
    add_legend(legend, graph_type, src_data, colors);

}

function add_legend(parent_el, graph_type, src_data, colors) {

    let legend_text = '<ul class="list-inline">';

    for (let i = 0; i < src_data.length; i++) {
        // name, result
        let party = src_data[i];
        if (party[1] === 0) {
            // skip
            continue;
        }
        let party_text = '<li class="list-inline-item">' + party[0] + ': ' + party[1];
        if (colors[i] !== undefined) {
            party_text = party_text + ' <span class="oi oi-media-stop" style="color: ' + colors[i] + '" title="Kleur ' + party[0] + '" aria-hidden="true"></span>';
        }
        party_text = party_text + '</li>';
        legend_text = legend_text + party_text;
    }

    legend_text = legend_text + '</ul>';

    if (graph_type === 'seats') {
        legend_text = 'Zetelverdeling' + legend_text;
    } else {
        legend_text = 'Resultaten' + legend_text;
    }

    parent_el.empty();
    parent_el.append(legend_text);
}
