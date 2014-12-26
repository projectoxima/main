	<div id="paper" class="paper" style="background:#fff"></div>

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
		$(function(){
			
			window.width = $('body').innerWidth()-200;
			window.height = $('body').innerHeight()-200;
			window.iwidth = 100;
			window.iheight = 60;
			window.graph = new joint.dia.Graph;
			window.paper = new joint.dia.Paper({
				el: $('#paper'), width: window.width, height: window.height, model: window.graph,
				gridSize: 1, interactive: false
			});
			window.paper.on('cell:pointerdown', 
				function(cellView, evt, x, y) { 
					console.log('cell view ' + cellView.model.id + ' was clicked'); 
					console.log(cellView.model.get('param'));
				}
			);
			window.node = new Array;
			window.scale = 1;
			
			function createNode(prop){
				var nd = new joint.shapes.org.Member({
						size: {width: window.iwidth, height: window.iheight}, 
						attrs: {
							'.card': {fill: '#ddd', stroke: '#eee'},
							image: {'xlink:href': 'assets/img/user.jpg', 
								x:'0', y:'0'},
							'.rank': {text: prop.alamat}, 
							'.name': {text: prop.nama_lengkap }
						}
					});
				nd.set('id', prop.id);
				nd.set('titik_id', prop.titik_id);
				nd.set('user_id', prop.user_id);
				nd.set('nama', prop.nama_lengkap);
				nd.set('alamat', prop.alamat);
				nd.on('change:position', function(element) {
					//~ console.log(element.id, ':', element.get('position'));
				})
				
				return nd;
			}
			
			var generateGraph = function(gr, callback){
				if(gr==undefined)
					return;
				window.enume++;
				
				var node = createNode(gr);
				window.node.push(node);
				if(gr.childs!=undefined && gr.childs.length>0){
					var async = 0;
					for(i in gr.childs){
						generateGraph(gr.childs[i], function(tnode){
							var link = new joint.dia.Link({
								source: {id: node.id}, target: {id: tnode.id},
								attrs: { '.marker-target': { d: 'M 4 0 L 0 2 L 4 4 z' } },
								smooth: true
							});
							window.node.push(tnode);
							window.node.push(link);
							async++;
							if(async>=gr.childs.length)
								callback(node);
						});
					}
				}else
					callback(node);
			};
			
			var scaleCanvas = function(){
				window.paper.scale(window.scale, window.scale);
			}
			
			$.post('<?php echo route_url('graph', 'generate_graph') ?>', function(res){
				window.enume = 0;
				generateGraph(res, function(node){
					window.graph.addCells(window.node);
					joint.layout.DirectedGraph.layout(window.graph, { setLinkVertices: false});
					//~ search for overflow
					var maxover = 0;
					for(n in window.node){
						if(window.node[n].attributes.position!=undefined
							&& window.node[n].attributes.position.x>=window.width){
							if(window.node[n].attributes.position.x>maxover){
								maxover = window.node[n].attributes.position.x;
								window.iwidth = window.node[n].attributes.size.width;
							}
						}
					}
					//~ autoscale
					window.scale = window.width/(maxover+window.iwidth);
					scaleCanvas();
				});
			}, 'json');
			
			$("#paper").bind('mousewheel', function(e){
				if(e.originalEvent.wheelDelta /120 > 0) {
					window.scale -= 0.01;
				}else{
					window.scale += 0.01;
				}
				scaleCanvas();
			});
			
		});
	</script>
	
	<style type="text/css">
		body {
			overflow:hidden;
		}
	</style>
