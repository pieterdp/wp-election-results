

function graph(selector, src_data, colors) {
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
        .value(function(d) { return d[1]; });

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
            .attr('fill', function(d) { return color(d.data[0]); });

        /*arc.append('text')
            .attr('transform', function(d) { return 'translate(' + label.centroid(d) + ')'; })
            .attr('dy', '0.35em')
            .text(function(d) { return d.data[0]; });*/
}
