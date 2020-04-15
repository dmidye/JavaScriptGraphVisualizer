var breadthFirstNodes = [];
var tempQueue = [];


function breadthFirst() {
	breadthFirstNodes = [];
	if(root == null) {
		return;
	}
	
	tempQueue.push(root);
	//printNode(root);
	
	while(tempQueue.length != 0) {
		node = tempQueue.shift();
		breadthFirstNodes.push(node);
		//printNode(node);
		if(node.left != null) {
			tempQueue.push(node.left);
		}
		
		if(node.right != null) {
			tempQueue.push(node.right);
		}
	}
}

function animateBF() {
	var tempDisable = delay*breadthFirstNodes.length-1;
	if(breadthFirstNodes.length < 2) {
		tempDisable = delay;
	}
	disableButtons();
	aBreadthFirst();
	setTimeout(function() {
		enableButtons();
	}, (delay*breadthFirstNodes.length-1)-delay);
}

function aBreadthFirst() {
	drawNodesInstant();
	setDelay();
	var i = 0;
	while(i<breadthFirstNodes.length){
        setTimeout(function(x){
            var color = '#8ba1c4';
			var xPos = breadthFirstNodes[x].width;
			var yPos = breadthFirstNodes[x].height;
			var size = 30;
			ctx.beginPath();
			ctx.arc(xPos, yPos, size, 0, 2 * Math.PI);
			ctx.fillStyle = color;
			ctx.fill();
		  
			ctx.font = "15px Arial";
			ctx.fillStyle = '#000000';
			ctx.fillText(breadthFirstNodes[x].key, xPos-7, yPos+3);
      }, delay*i, i);
	  i++;
    }
	return;
}