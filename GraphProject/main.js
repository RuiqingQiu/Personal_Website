(function($){

  var Renderer = function(canvas){
    var canvas = $(canvas).get(0)
    var ctx = canvas.getContext("2d");
    var gfx = arbor.Graphics(canvas)
    var particleSystem

    var that = {
      init:function(system){
        //
        // the particle system will call the init function once, right before the
        // first frame is to be drawn. it's a good place to set up the canvas and
        // to pass the canvas size to the particle system
        //
        // save a reference to the particle system for use in the .redraw() loop
        particleSystem = system

        // inform the system of the screen dimensions so it can map coords for us.
        // if the canvas is ever resized, screenSize should be called again with
        // the new dimensions
        particleSystem.screenSize(canvas.width, canvas.height) 
        particleSystem.screenPadding(100) // leave an extra 80px of whitespace per side
        
        // set up some event handlers to allow for node-dragging
        that.initMouseHandling()
      },
      
      redraw:function(){
        // 
        // redraw will be called repeatedly during the run whenever the node positions
        // change. the new positions for the nodes can be accessed by looking at the
        // .p attribute of a given node. however the p.x & p.y values are in the coordinates
        // of the particle system rather than the screen. you can either map them to
        // the screen yourself, or use the convenience iterators .eachNode (and .eachEdge)
        // which allow you to step through the actual node objects but also pass an
        // x,y point in the screen's coordinate system
        // 
        ctx.fillStyle = "white"
        ctx.fillRect(0,0, canvas.width, canvas.height)
        
        var nodeBoxes = {}
        particleSystem.eachNode(function(node, pt){
          // node: {mass:#, p:{x,y}, name:"", data:{}}
          // pt:   {x:#, y:#}  node position in screen coords

          // draw a rectangle centered at pt
          var w = 10
          if(node.data.evidence)
            ctx.fillStyle = "red"
          else if(node.data.target)
            ctx.fillStyle = "blue"
          else
            ctx.fillStyle = "black"
          //ctx.fillStyle = (node.data.evidence) ? "red" : "black"
          //ctx.fillRect(pt.x-w/2, pt.y-w/2, w,w)
          ctx.beginPath()
          ctx.arc(node.p.x, node.p.y, 10, 0, 2*Math.PI);
          ctx.fillText(node.data.name, node.p.x+10, node.p.y);
          ctx.fill();
          nodeBoxes[node.name] = [node.p.x, node.p.y, 22, 15]
        })   

        particleSystem.eachEdge(function(edge, pt1, pt2){
          // edge: {source:Node, target:Node, length:#, data:{}}
          // pt1:  {x:#, y:#}  source position in screen coords
          // pt2:  {x:#, y:#}  target position in screen coords

          // draw a line from pt1 to pt2
          var weight = edge.data.weight
          var start = nodeBoxes[edge.data.name.charAt(0)]
          var end = nodeBoxes[edge.data.name.charAt(1)]
          ctx.save() 
          ctx.beginPath()
          ctx.lineWidth = (!isNaN(weight)) ? parseFloat(weight) : 1
          ctx.strokeStyle = "#cccccc"
          ctx.fillStyle = null

          ctx.moveTo(start[0], start[1])//Tail
          var endx = end[0]
          var endy = end[1]
          if(start[0] > end[0]){//The node is on the left side
            endx = end[0] + 10;
            endy = end[1] - 10;
          }                     
          else{
            endx = end[0] - 10;
            endy = end[1] - 10;
          }
          //ctx.lineTo(end[0]-5, end[1]-5)//Head
          ctx.lineTo(endx, endy)

          ctx.stroke()
          ctx.restore()

          // draw an arrowhead if this is a -> style edge
          
          ctx.save()
          // move to the head position of the edge we just drew
          var wt = !isNaN(weight) ? parseFloat(weight) : 1
          var arrowLength = 12 + wt
          var arrowWidth = 4 + wt
          ctx.fillStyle = "#cccccc"
          ctx.translate(endx, endy);
          ctx.rotate(Math.atan2(endy - start[1], endx - start[0]));

          // delete some of the edge that's already there (so the point isn't hidden)
          ctx.clearRect(-arrowLength/2,-wt/2, arrowLength/2,wt)

          // draw the chevron
          ctx.beginPath();
          ctx.moveTo(-arrowLength, arrowWidth);
          ctx.lineTo(0, 0);
          ctx.lineTo(-arrowLength, -arrowWidth);
          ctx.lineTo(-arrowLength * 0.8, -0);
          ctx.closePath();
          ctx.fill();
          ctx.restore()

        })

      },
      
      initMouseHandling:function(){
        // no-nonsense drag and drop (thanks springy.js)
        var dragged = null;

        // set up a handler object that will initially listen for mousedowns then
        // for moves and mouseups while dragging
        var handler = {
          clicked:function(e){
            var pos = $(canvas).offset();
            _mouseP = arbor.Point(e.pageX-pos.left, e.pageY-pos.top)
            dragged = particleSystem.nearest(_mouseP);

            if (dragged && dragged.node !== null){
              // while we're dragging, don't let physics move the node
              dragged.node.fixed = true
            }

            $(canvas).bind('mousemove', handler.dragged)
            $(window).bind('mouseup', handler.dropped)

            return false
          },
          dragged:function(e){
            var pos = $(canvas).offset();
            var s = arbor.Point(e.pageX-pos.left, e.pageY-pos.top)

            if (dragged && dragged.node !== null){
              var p = particleSystem.fromScreen(s)
              dragged.node.p = p
            }

            return false
          },

          dropped:function(e){
            if (dragged===null || dragged.node===undefined) return
            if (dragged.node !== null) dragged.node.fixed = false
            dragged.node.tempMass = 1000
            dragged = null
            $(canvas).unbind('mousemove', handler.dragged)
            $(window).unbind('mouseup', handler.dropped)
            _mouseP = null
            return false
          }
        }
        
        // start listening
        $(canvas).mousedown(handler.clicked);

      },
      
    }
    return that
  }    

   // helpers for figuring out where to draw arrows (thanks springy.js)
  var intersect_line_line = function(p1, p2, p3, p4)
  {
    var denom = ((p4.y - p3.y)*(p2.x - p1.x) - (p4.x - p3.x)*(p2.y - p1.y));
    if (denom === 0) return false // lines are parallel
    var ua = ((p4.x - p3.x)*(p1.y - p3.y) - (p4.y - p3.y)*(p1.x - p3.x)) / denom;
    var ub = ((p2.x - p1.x)*(p1.y - p3.y) - (p2.y - p1.y)*(p1.x - p3.x)) / denom;

    if (ua < 0 || ua > 1 || ub < 0 || ub > 1)  return false
      return arbor.Point(p1.x + ua * (p2.x - p1.x), p1.y + ua * (p2.y - p1.y));
  }

  var intersect_line_box = function(p1, p2, boxTuple)
  {
    var p3 = {x:boxTuple[0], y:boxTuple[1]},
        w = boxTuple[2],
        h = boxTuple[3]

          var tl = {x: p3.x, y: p3.y};
    var tr = {x: p3.x + w, y: p3.y};
    var bl = {x: p3.x, y: p3.y + h};
    var br = {x: p3.x + w, y: p3.y + h};

    return intersect_line_line(p1, p2, tl, tr) ||
      intersect_line_line(p1, p2, tr, br) ||
      intersect_line_line(p1, p2, br, bl) ||
      intersect_line_line(p1, p2, bl, tl) ||
      false
  }

  $(document).ready(function(){
    var sys = arbor.ParticleSystem(0, 0, 0.5) // create the system with sensible repulsion/stiffness/friction
    sys.parameters({gravity:true}) // use center-gravity to make the graph settle nicely (ymmv)
    sys.renderer = Renderer("#viewport") // our newly created renderer will have its .init() method called shortly by sys...

    // add some nodes to the graph and watch it go...
    /*sys.addEdge('a','b')
    sys.addEdge('a','c')
    sys.addEdge('a','d')
    sys.addEdge('a','e')
    sys.addEdge('b', 'd')
    sys.addNode('f', {alone:true, mass:.25})
    */
    nodeA = sys.addNode("A", {name: "A", x: 350, y: 100, mass: 2, evidence:  true, target: false})
    nodeB = sys.addNode("B", {name: "B", x: 50, y: 200, mass: 2, evidence: false, target: false})
    nodeC = sys.addNode("C", {name: "C", x: 250, y: 200, mass: 2, evidence: true, target: false})
    nodeD = sys.addNode("D", {name: "D", x: 450, y: 200, mass: 2, evidence: false, target: true})
    nodeE = sys.addNode("E", {name: "E", x: 650, y: 200, mass: 2, evidence: true, target: false})
    nodeF = sys.addNode("F", {name: "F", x: 150, y: 300, mass: 2, evidence: false, target: false})
    nodeG = sys.addNode("G", {name: "G", x: 350, y: 300, mass: 2, evidence: true, target: false})
    nodeH = sys.addNode("H", {name: "H", x: 550, y: 300, mass: 2, evidence: true, target: false})

    edgeAC = sys.addEdge(nodeA, nodeC, {weight: 2, name: "AC"})

    edgeCF = sys.addEdge(nodeC, nodeF, {weight: 2, name: "CF"})
    edgeBF = sys.addEdge(nodeB, nodeF, {weight: 2, name: "BF"})
    edgeCG = sys.addEdge(nodeC, nodeG, {weight: 2, name: "CG"})
    edgeAD = sys.addEdge(nodeA, nodeD, {weight: 2, name: "AD"})
    edgeDG = sys.addEdge(nodeD, nodeG, {weight: 2, name: "DG"})
    edgeDH = sys.addEdge(nodeD, nodeH, {weight: 2, name: "DH"})
    edgeEH = sys.addEdge(nodeE, nodeH, {weight: 2, name: "EH"})
    // or, equivalently:
    //
    // sys.graft({
    //   nodes:{
    //     f:{alone:true, mass:.25}
    //   }, 
    //   edges:{
    //     a:{ b:{},
    //         c:{},
    //         d:{},
    //         e:{}
    //     }
    //   }
    // })
    
  })

})(this.jQuery)
