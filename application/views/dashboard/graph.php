<div id="paper" class="paper"></div>
		<script type="text/javascript">
			/* custom rect */
			joint.shapes.basic.newRect = joint.shapes.basic.Generic.extend({
				markup: '<g class="rotatable"><g class="scalable"><rect/></g><text/></g>',
				defaults: joint.util.deepSupplement({
					type: 'basic.newRect',
					attrs: {
						'rect': { fill: 'white', stroke: 'black', 'follow-scale': true, width: 80, height: 40 },
						'text': { 'font-size': 14, 'ref-x': .5, 'ref-y': .5, ref: 'rect', 'y-alignment': 'middle', 'x-alignment': 'middle' }
					},
					param: 'foo'
				}, joint.shapes.basic.Generic.prototype.defaults)
			})
		</script>
		<script type="text/javascript">
			var graph = new joint.dia.Graph
			var paper = new joint.dia.Paper({
				el: $('#paper'), width: 300, height: 300, model: graph, gridSize: 10, interactive: false
			})
			var rect = new joint.shapes.basic.Rect({
				position: {x: 10, y: 10}, size: {width: 30, height: 10}, 
				attrs: {rect: {fill: 'blue'}, text: {text: 'test', fill: 'white', interactive:false}}
			})
			var rect2 = rect.clone()
			rect2.translate(100)
			var rect3 = new joint.shapes.basic.newRect({
				position: {x: 70, y: 70}, size: {width: 30, height: 10}, 
				attrs: {rect: {fill: 'blue'}, text: {text: 'aza', fill: 'white'}}
			})
			rect3.set('param','yovie')
			var link = new joint.dia.Link({
				source: {id: rect.id}, target: {id: rect2.id}
			})
			graph.addCells([rect, rect2, rect3, link])
			
			/* action */
			rect.on('change:position', function(element) {
				console.log(element.id, ':', element.get('position'));
			})
			paper.on('cell:pointerdown', 
				function(cellView, evt, x, y) { 
					console.log('cell view ' + cellView.model.id + ' was clicked'); 
					console.log(cellView.model.get('param')); 
					//tmp = rect3.clone()
					//tmp.translate(10)
					//graph.addCells([tmp]);
				}
			)
			//~ paper.scale(10, 10);
		</script>
