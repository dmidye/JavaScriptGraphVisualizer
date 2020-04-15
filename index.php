<?php include 'view/header.php'; ?>
	
	<div class="outer">
		<div class="sidebar">
		
			<div class="enter-list">
				<label>Enter a comma separated list:</label>
				<div class="aList">
					<input type="radio" name="optradio" id="list" onchange="setType()" checked>
					<input type="text" id="node-list" >
				</div>
			</div>
			<br>
			<div class="enter-one">
				<label>Add one node at a time:</label>
				<div class="one">
					<input type="radio" name="optradio" id="one" onchange="setType()">
					<input type="text" id="node-one" size="5" onkeypress='validate(event)' disabled>
					<div class="addBtn">
						<button type="button" id="add-one" class="btn btn-secondary btn-sm"  onclick="addOneNode()">Add</button>
					</div>
				</div>
			</div>
			
			<div class="text-center m-4 ml-5">
				<button type="button" id="show-tree" class="btn btn-primary"  onclick="addListOfNodes()">Show Tree</button>
			</div>
			
			<div class="btn-group btn-group-toggle mb-2 ml-2" data-toggle="buttons">
			  <label class="btn btn-secondary active">
				<input type="radio" name="options" id="fast" value="200" onchange="setDelay()" checked> Fast
			  </label>
			  <label class="btn btn-secondary">
				<input type="radio" name="options" id="medium" value="500" onchange="setDelay()"> Medium
			  </label>
			  <label class="btn btn-secondary">
				<input type="radio" name="options" id="slow" value="1000" onchange="setDelay()"> Slow
			  </label>
			</div>
		
			<div class="orderBtns">
				
				<div class="preorderBtn">
					<button type="button" id="preorder" class="btn btn-primary mb-2"  onclick="animatePreorder()">Preorder</button>
				</div>
				
				<div class="postorderBtn">
					<button type="button" class="btn btn-primary mb-2" id="postorder" onclick="animatePostorder()">Postorder</button>
				</div>
				
				<div class="inorderBtn">
					<button type="button" class="btn btn-primary ml-5" id="inorder" onclick="animateInorder()">Inorder</button>
				</div>
				
			</div>
			<hr>
			<div class="bfsBtn">
					<button type="button" class="btn btn-primary" id="bfs" onclick="animateBF()">Breadth First</button>
			</div>
				
		</div>
		
		<div class="canvas">
			<canvas id="canvasArea" width="1000" height="500" style="border:2px solid black"></canvas>
		</div>
	</div>
	
	
<?php include 'view/footer.php'; ?>