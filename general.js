  var canvas;
  var ctx;
	
  window.onload = function() {
    canvas = document.getElementById("canvasArea");
    ctx = canvas.getContext("2d");
	
	//set initial positions of radio buttons
	document.getElementById("list").checked = true;
	document.getElementById("node-one").disabled = true;
	document.getElementById("add-one").disabled = true;
  }

  function printNode(node) {
	  console.log("Node: " + node.key);
	  console.log("   w: " + node.width);
	  console.log("   l: " + node.height);
  }
  
  function disableButtons() {
	  document.getElementById("preorder").disabled = true;
	  document.getElementById("show-tree").disabled = true;
	  document.getElementById("postorder").disabled = true;
	  document.getElementById("inorder").disabled = true;
	  document.getElementById("bfs").disabled = true;
  }
  
  function enableButtons() {
	  var listEntry = document.getElementById("list");
	  if(listEntry.checked) {
		  document.getElementById("preorder").disabled = false;
		  document.getElementById("show-tree").disabled = false;
		  document.getElementById("postorder").disabled = false;
		  document.getElementById("inorder").disabled = false;
		  document.getElementById("bfs").disabled = false;
	  } else {
		  document.getElementById("preorder").disabled = false;
		  document.getElementById("postorder").disabled = false;
		  document.getElementById("inorder").disabled = false;
		  document.getElementById("bfs").disabled = false;
	  }
  }
  
function enableButtonsForAddOne() {
	  document.getElementById("preorder").disabled = false;
	  document.getElementById("show-tree").disabled = false;
	  document.getElementById("postorder").disabled = false;
	  document.getElementById("inorder").disabled = false;
	  document.getElementById("bfs").disabled = false;
  }
  
  function enableButtonsForAddOne() {
	  document.getElementById("preorder").disabled = false;
	  document.getElementById("show-tree").disabled = false;
	  document.getElementById("postorder").disabled = false;
	  document.getElementById("inorder").disabled = false;
	  document.getElementById("bfs").disabled = false;
  }
  
  //this is resetting all the important lists and globals if the list or add-one radio buttons are changed
  function setType(){
	  var listEntry = document.getElementById("list");
	  if(listEntry.checked) {
		values = [];
		ctx.clearRect(0, 0, canvas.width, canvas.height);
		this.nodes = [];
		this.root = null;
		this.preorderNodes = [];
		this.postorderNodes = [];
		this.inorderNodes = [];
		breadthFirstNodes = [];
		tempQueue = [];
	    document.getElementById("node-one").disabled = true;
	    document.getElementById("node-list").disabled = false;
		document.getElementById("show-tree").disabled = false;
		document.getElementById("add-one").disabled = true;
	  }
	  else {
		values = [];
		ctx.clearRect(0, 0, canvas.width, canvas.height);
		this.tempNode = null;
		this.nodes = [];
		this.root = null;
		this.preorderNodes = [];
		this.postorderNodes = [];
		this.inorderNodes = [];
		breadthFirstNodes = [];
		tempQueue = [];
		document.getElementById("show-tree").disabled = true;
	    document.getElementById("node-one").disabled = false; 
	    document.getElementById("node-list").disabled = true;	
		document.getElementById("add-one").disabled = false;		
	  }
  }
  
  function validate(evt) {
	  var theEvent = evt || window.event;

	  // Handle paste
	  if (theEvent.type === 'paste') {
		  key = event.clipboardData.getData('text/plain');
	  } else {
	  // Handle key press
		  var key = theEvent.keyCode || theEvent.which;
		  key = String.fromCharCode(key);
	  }
	  //var regex = /^-?([0-9]|\.)/;
	  var regex = /^-?\d*\.?\d{0,9}$/;
	  if( !regex.test(key) ) {
		theEvent.returnValue = false;
		if(theEvent.preventDefault) theEvent.preventDefault();
	  }
  }
  
  function setDelay() {
	if (document.getElementById('fast').checked) {
		delay = document.getElementById('fast').value;
	}
	if (document.getElementById('medium').checked) {
		delay = document.getElementById('medium').value;
	}
	if (document.getElementById('slow').checked) {
		delay = document.getElementById('slow').value;
	}
  }
  
  function parseList() {
	  var listString = document.getElementById("node-list").value;
	  values.push.apply(values, listString.split(",").filter(x => x.trim().length && !isNaN(x)).map(Number));
  }
  
  function parseValue() {
	  var listString = document.getElementById("node-one").value;
	  values.push.apply(values, listString.split(",").filter(x => x.trim().length && !isNaN(x)).map(Number));
  }