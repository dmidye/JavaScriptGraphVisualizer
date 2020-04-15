  var preorderNodes = [];
  var postorderNodes = [];
  var inorderNodes = [];
  
  // START OF PREORDER OPERATIONS
  function preorder() {
	  this.preorderNodes = [];
	  getPreorder(this.root);
  }
  
  function getPreorder(node) {
	  if(node != null) {
		  preorderNodes.push(node);
		  getPreorder(node.left);
		  getPreorder(node.right);
	  }
  }
  
  function animatePreorder() {
	  var tempDisable = delay*preorderNodes.length-1;
	  if(preorderNodes.length < 2) {
		  tempDisable = delay;
	  }
	  disableButtons();
	  aPreorder();
	  setTimeout(function() {
		 enableButtons();
	  }, (delay*preorderNodes.length-1)-delay);
  }
  
  function aPreorder() {
	drawNodesInstant();
	setDelay();
	var i = 0;
	while(i<preorderNodes.length){
        setTimeout(function(x){
            var color = '#8ba1c4';
			var xPos = preorderNodes[x].width;
			var yPos = preorderNodes[x].height;
			var size = 30;
			ctx.beginPath();
			ctx.arc(xPos, yPos, size, 0, 2 * Math.PI);
			ctx.fillStyle = color;
			ctx.fill();
		  
			ctx.font = "15px Arial";
			ctx.fillStyle = '#000000';
			ctx.fillText(preorderNodes[x].key, xPos-7, yPos+3);
      }, delay*i, i);
	  i++;
    }
	return;
  }
  
  
  // START OF POSTORDER OPERATIONS
  function postorder() {
	  this.postorderNodes = [];
	  getPostorder(this.root);
  }
  
  function getPostorder(node) {
	  if(node != null) {
		  getPostorder(node.left);
		  getPostorder(node.right);
		  postorderNodes.push(node);
	  }
  }
  
  function animatePostorder() {
	  var tempDisable = delay*postorderNodes.length-1;
	  if(postorderNodes.length < 2) {
		  tempDisable = delay;
	  }
	  disableButtons();
	  aPostorder();
	  setTimeout(function() {
		  enableButtons();
	  }, (delay*postorderNodes.length-1)-delay);
  }
  
  function aPostorder() {
	drawNodesInstant();
	setDelay();
	var i = 0;
	while(i<postorderNodes.length){
        setTimeout(function(x){
            var color = '#8ba1c4';
			var xPos = postorderNodes[x].width;
			var yPos = postorderNodes[x].height;
			var size = 30;
			ctx.beginPath();
			ctx.arc(xPos, yPos, size, 0, 2 * Math.PI);
			ctx.fillStyle = color;
			ctx.fill();
		  
			ctx.font = "15px Arial";
			ctx.fillStyle = '#000000';
			ctx.fillText(postorderNodes[x].key, xPos-7, yPos+3);
      }, delay*i, i);
	  i++;
    }
	return;
  }
  
  
  // START OF INORDER OPERATIONS
  function inorder() {
	  this.inorderNodes = [];
	  getInorder(this.root);
  }
  
  function getInorder(node) {
	  if(node != null) {
		  getInorder(node.left);
		  inorderNodes.push(node);
		  getInorder(node.right);
	  }
  }
  
  function animateInorder() {
	  var tempDisable = delay*inorderNodes.length-1;
	  if(inorderNodes.length < 2) {
		  tempDisable = delay;
	  }
	  disableButtons();
	  aInorder();
	  setTimeout(function() {
		  enableButtons();
	  }, (delay*inorderNodes.length-1)-delay);
  }
  
  function aInorder() {
	drawNodesInstant();
	setDelay();
	var i = 0;
	while(i<inorderNodes.length){
        setTimeout(function(x){
            var color = '#8ba1c4';
			var xPos = inorderNodes[x].width;
			var yPos = inorderNodes[x].height;
			var size = 30;
			ctx.beginPath();
			ctx.arc(xPos, yPos, size, 0, 2 * Math.PI);
			ctx.fillStyle = color;
			ctx.fill();
		  
			ctx.font = "15px Arial";
			ctx.fillStyle = '#000000';
			ctx.fillText(inorderNodes[x].key, xPos-7, yPos+3);
      }, delay*i, i);
	  i++;
    }
	return;
  }