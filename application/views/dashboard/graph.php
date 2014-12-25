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
					//tmp = rect3.clone()
					//tmp.translate(10)
					//graph.addCells([tmp]);
				}
			);
			//~ window.paper.scale(10, 10);
			window.node = new Array;
			
			function createNode(prop, xx, yy){
				var nd = new joint.shapes.org.Member({
						position: {x: xx, y: yy}, 
						size: {width: window.iwidth, height: window.iheight}, 
						attrs: {
							'.card': { fill: '#ddd', stroke: '#eee'},
							image: { 'xlink:href': 'assets/img/user.jpg' },
							'.rank': { text: prop.alamat}, '.name': { text: prop.nama_lengkap }
						}
					});
				nd.set('id', prop.id);
				nd.set('titik_id', prop.titik_id);
				nd.set('user_id', prop.user_id);
				nd.set('nama', prop.nama_lengkap);
				nd.set('alamat', prop.alamat);
				nd.on('change:position', function(element) {
					console.log(element.id, ':', element.get('position'));
				})
				
				return nd;
			}
			
			function rFact(num){
				if (num === 0)
					{ return 1; }
				else
					{ return num * rFact( num - 1 ); }
			}
			
			function getX(num){
				md = rFact(num);
				ln = Math.sqrt(md);
				nd = ln;
				console.log(num + ' ');
			}
			
			function getY(num){
				md = rFact(num);
			}
			
			function generateGraph(gr, num){
				if(gr==undefined)
					return;
				
				var node = createNode(gr, getX(num), getY(num));
				
				window.node.push(node);
				
				if(gr.childs!=undefined && gr.childs.length>0){
					for(i in gr.childs){
						var tmp = num;
						tmp++;
						var tnode = generateGraph(gr.childs[i], tmp);
						var link = new joint.dia.Link({
							source: {id: node.id}, target: {id: tnode.id}
						});
						window.node.push(link);
					}
				}
				
				return node;
			}
			
			$.get('<?php echo route_url('graph', 'generate_graph') ?>', function(res){
				generateGraph(res, 0);
				window.graph.addCells(window.node);
			}, 'json');
			
		});
	</script>
