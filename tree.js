// global variables
  
  var values = []//[30, 24, 42, 17, 26, 36, 81, 5, 25, 28, 56, 37, 31, 19];
  var root;// = new Node(values[0], 500, 40, null, null, 1, 0);
  var nodes = [];
  var delay = 0;
  var tempKey = undefined;
  var tempNode;
  const startHeight = 60;
  const startWidth = 500;
  var sizeFlag = false;
  
  function Node(key, width, height, left, right, position, level, parent) {
	this.key = key;
	this.width = width;
	this.height = height;
	this.left = left;
	this.right = right;
	this.position = position;
	this.level = level;
	this.parent = parent;
  }
  
  function addListOfNodes() {
	  ctx.clearRect(0, 0, canvas.width, canvas.height);
	  nodes = [];
	  values = [];
	  parseList();
	  var numCalls = 0;
	  var position = 1;
	  this.root = new Node(values[0], 500, 40, null, null, 1, 0);
	  this.nodes.push(root);
	  
	  for(let i = 1; i < values.length; i++) {
		  insert(values[i], startWidth, startHeight, position, numCalls);
	  }
	  drawNodesInstant();
	  drawLinesList();
	
	  //get the lists for orders
	  preorder();
	  postorder();
	  inorder();
	  breadthFirst();
  }
  
  function addOneNode() {
	  document.getElementById("add-one").disabled = true;//disabled while animating and stuff
	  setDelay();
	  
	  if(document.getElementById("one").checked) {
		  drawNodesInstant();
		  parseValue();
	  }
	  tempKey = undefined;

	  tempKey = values[values.length-1];//tempKey is used to fix an issue with drawing travel nodes down both sides of the tree
	  var numCalls = 0;
	  var position = 1;
	  if(this.root == null) {//if root is null, assign the parsed value to root and push value to values list then draw node
		  this.root = new Node(values[0], 500, 40, null, null, 1, 0);
	      this.nodes.push(root);
		  drawNode(this.root);
	  } else {
		insert(tempKey, startWidth, startHeight, position, numCalls);
	  }
	  
	  var travelPath = [];
	  var temp = nodes[nodes.length-1]; 
	  var justAdded = nodes[nodes.length-1];
	  var eraseThese = [];
	  
	  //go up the tree with parent references and add each parent to a stack
	  while(temp.parent != null) {
		  travelPath.push(temp.parent);
		  temp = temp.parent;
	  }
	  
	  var travel = new Node(tempKey, this.root.width, this.root.height, null, null, 0, 0);
	  travelNode(travel, tempKey);
	  eraseThese.push(travel);
	  
	  var i = 0;
	  var len = travelPath.length;
	  function drawTravelPath () {    
	    var popped = travelPath.pop();  		
		setTimeout(function () { 
			travel = new Node(tempKey, popped.width, popped.height, null, null, 0, 0);
			travelNode(travel, tempKey);
			eraseThese.push(travel);
			i++;
			if(i < len) {
				drawTravelPath();
			}
		  }, delay);
	  }
	  if(nodes.length > 1) {
		drawTravelPath();
	  }
	  
	  //wait for traveling to finish to draw the new node
	  setTimeout(function(){
		drawNode(nodes[nodes.length-1]);
		drawLinesOne(ctx, nodes[nodes.length-1]);
	  }, (len+1)*delay);
	  
	  //Do everything that needs to be done after the travel is complete
	  setTimeout(function(){
		eraseNodes(eraseThese);
		document.getElementById("add-one").disabled = false;
		drawNodesInstant();
	  }, (len+1)*delay);
	  
	  //get the lists for orders
	  preorder();
	  postorder();
	  inorder();
	  breadthFirst();
 }
  
  function insert(key, width, height, position, numCalls) {
	  addNode(this.root, key, width, height, position, numCalls, this.root);
  }
  
  function addNode(node, key, width, height, position, numCalls, parent) {
	  if(node == null) {
		  node = new Node(key, width, height, null, null, position, numCalls, parent);
		  //tempNode = new Node(key, width, height, null, null, position, numCalls, parent);
		  this.nodes.push(node);
		  return node;
	  }
	  
	  var parent = node;
	  numCalls++;
	  var nodeKey = node.key;
	  var newKey = key;
	  
	  var divisor = (Math.pow(2, numCalls)+1);
	  if(newKey < nodeKey) {
		  position = position * 2 - 1;
		  node.left = addNode(node.left, key, (1000/divisor)*position, height+80, position, numCalls, parent);
	  } else {
		  position = position * 2;
		  node.right = addNode(node.right, key, (1000/divisor)*position, height+80, position, numCalls, parent);
	  }
	  return node;
  }
  
  function drawNodesInstant() {
	  for(let i = 0; i < values.length; i++) {
		  drawNode(nodes[i]);
	  }
  }
  
  function travelNode(node, key) {
	if(key != undefined) {
		var xPos = node.width-70;
		var yPos = node.height;
		var size = 30;
		color = '#a4decc';

		ctx.beginPath();
		ctx.arc(xPos, yPos, size, 0, 2 * Math.PI);
		ctx.fillStyle = color;
		
		ctx.fill();
		ctx.font = "15px Arial";
		ctx.fillStyle = '#000000';
		ctx.fillText(key, xPos-7, yPos+3);
	}
  }
  
  function eraseNode(node) {
	var xPos = node.width-70;
	var yPos = node.height;
	var size = 31;
	color = '#e6f7ff';

	ctx.beginPath();
	ctx.arc(xPos, yPos, size, 0, 2 * Math.PI);
	ctx.fillStyle = color;
	ctx.fill();
  }
  
  function eraseNodes(arr) {
	  for(let i = 0; i < arr.length; i++) {
		  eraseNode(arr[i]);
	  }
  } 
  
  function drawNode(node) {
	var xPos = node.width;
	var yPos = node.height;
	var size = 30;
	color = '#FFFFFF';
	
	ctx.beginPath();
	ctx.arc(xPos, yPos, size, 0, 2 * Math.PI);
	ctx.fillStyle = color;
	
	ctx.fill();
	ctx.font = "15px Arial";
	ctx.fillStyle = '#000000';
	ctx.fillText(node.key, xPos-7, yPos+3);
  }
    
  function drawLinesOne(ctx, node) {
	  //drawing FROM child TO parent
	  if(node.parent != null) {
		ctx.beginPath();
		ctx.moveTo(node.width, node.height-30);
		ctx.lineTo(node.parent.width, node.parent.height+30);
		ctx.stroke();
	  }
  }
  
  function drawLinesList() {
	//all these conditions are so lines don't get drawn over lines
	for(let i = 0; i < nodes.length; i++) {
		var node = nodes[i];
		if(node.left == null && node.right != null) {
			ctx.beginPath();
			ctx.moveTo(node.right.width, node.right.height-30);
			ctx.lineTo(node.width+10, node.height+30);
			ctx.stroke(); 	
		}
		else if(node.right == null && node.left != null) {
			ctx.beginPath();
			ctx.moveTo(node.left.width, node.left.height-30);
			ctx.lineTo(node.width-10, node.height+30);
			ctx.stroke(); 
		}
		else if(node.right != null && node.left.key == tempKey) {
			ctx.beginPath();
			ctx.moveTo(node.left.width, node.left.height-30);
			ctx.lineTo(node.width-10, node.height+30);
			ctx.stroke(); 
		}
		else if(node.left != null && node.right.key == tempKey) {
			ctx.beginPath();
			ctx.moveTo(node.right.width, node.right.height-30);
			ctx.lineTo(node.width+10, node.height+30);
			ctx.stroke(); 	
		} 
		else if(node.right != null && node.left != null) {
			ctx.beginPath();
			ctx.moveTo(node.right.width, node.right.height-30);
			ctx.lineTo(node.width+10, node.height+30);
			ctx.stroke(); 	
			ctx.beginPath();
			ctx.moveTo(node.left.width, node.left.height-30);
			ctx.lineTo(node.width-10, node.height+30);
			ctx.stroke(); 
		}
	}
  }