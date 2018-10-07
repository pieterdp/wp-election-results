# wp-election-results
Show the Belgian election results as a nice graph using a shortcode. The plugin shows results in Dutch.

Made using [d3](https://d3js.org/), [Bootstrap 4](https://getbootstrap.com/), [DataTables](https://datatables.net/) and [Iconic Icons](https://useiconic.com/open/).

## Manual

For any election, a manual shortcode is provided that transfers the data you enter in a nice graph and table for your visitors.

```
[hx_election name="Wingene" counted="5" total="5" seats="20" id="wingene_2018"]
[hx_result name="Lijst van de Burgemeester" percentage="60" seats="12" color="orange" id="wingene_2018"]
[hx_result name="Oppositie" percentage="40" seats="80" color="blue" id="wingene_2018"]
[/hx_election]
```

### Parameters

#### `hx_election`

* `name`: Name of the town/city/country.
* `counted`: Amount of polling stations that have already submitted their results.
* `total`: Total amount of polling stations.
* `seats`: Total amount of seats up for election.
* `id`: An unique ID (per page) that ties the `hx_election` to the `hx_result` tags.


#### `hx_result`
Used to display the results of a single party.

* `name`: Name of the party.
* `percentage`: Percentage of the vote.
* `seats`: Amount of seats the party won.
* `color`: Color (either in _hex_ or using HTML names) for displaying the party results in the graph.
* `id`: The ID of the `hx_election` this `hx_result` belongs to.


## Automatic

For the municipal elections in Flanders, it is possible to fetch the data automatically from [www.vlaanderenkiest.be](https://www.vlaanderenkiest.be).

```
[hx_election_auto name="Wingene" vl_id="37018" vl_year="2018" vl_api_version="2018" id="wingene_2018"]
```

### Parameters

#### `hx_election_auto`

* `name`: Name of the town.
* `vl_id`: The ID of the town on [www.vlaanderenkiest.be](https://www.vlaanderenkiest.be).
* `vl_year`: The year of this election cycle (e.g. 2018, 2012, ...).
* `vl_api_version`: The API changed between the 2012 and 2018 elections. For results before and including 2012, use `2012`; else use `2018`.
* `id`: An unique ID (per page).


## Examples
See [www.radiooostwest.be](https://www.radiooostwest.be/zendschema/verkiezingen-2018/tielt/) for an example.
