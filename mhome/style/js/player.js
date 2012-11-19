
function init(container) {
	container = document.getElementById(container);
	camera = new THREE.PerspectiveCamera( 75, window.innerWidth / window.innerHeight, 1, 1000 );

	scene = new THREE.Scene();

	var sides = [
		{
			url: pano_front,
			position: new THREE.Vector3( 0, 0,  512 ),
			rotation: new THREE.Vector3( 0, Math.PI, 0 )
		},
		{
			url: pano_right,
			position: new THREE.Vector3( -512, 0, 0 ),
			rotation: new THREE.Vector3( 0, Math.PI / 2, 0 )
		},
		{
			url: pano_back,
			position: new THREE.Vector3( 0, 0, -512 ),
			rotation: new THREE.Vector3( 0, 0, 0 )
		},
		{
			url: pano_left,
			position: new THREE.Vector3( 512, 0, 0 ),
			rotation: new THREE.Vector3( 0, -Math.PI / 2, 0 )
		},
		{
			url: pano_top,
			position: new THREE.Vector3( 0,  512, 0 ),
			rotation: new THREE.Vector3( Math.PI / 2, 0, Math.PI )
		},
		{
			url: pano_bottom,
			position: new THREE.Vector3( 0, -512, 0 ),
			rotation: new THREE.Vector3( - Math.PI / 2, 0, Math.PI )
		}
		
	];

	for ( var i = 0; i < sides.length; i ++ ) {

		var side = sides[ i ];
		if(i==0){
			var element = new Image(); 
			element.width = 1026; // 2 pixels extra to close the gap.
			element.src = side.url;
			element.onload = function (){
				$("#loading").hide();
			} 
		}
		else{
			var element = document.createElement( 'img' );
			element.width = 1026; // 2 pixels extra to close the gap.
			element.src = side.url;
		}

		var object = new THREE.CSS3DObject( element );
		object.position = side.position;
		object.rotation = side.rotation;
		scene.add( object );

	}

	renderer = new THREE.CSS3DRenderer();
	renderer.setSize( window.innerWidth, window.innerHeight );
	container.appendChild( renderer.domElement );

	//

	document.addEventListener( 'mousedown', onDocumentMouseDown, false );
	document.addEventListener( 'mousewheel', onDocumentMouseWheel, false );

	document.addEventListener( 'touchstart', onDocumentTouchStart, false );
	document.addEventListener( 'touchmove', onDocumentTouchMove, false );

	window.addEventListener( 'resize', onWindowResize, false );

}

function onWindowResize() {

	camera.aspect = window.innerWidth / window.innerHeight;
	camera.updateProjectionMatrix();

	renderer.setSize( window.innerWidth, window.innerHeight );

}

function onDocumentMouseDown( event ) {

	event.preventDefault();

	document.addEventListener( 'mousemove', onDocumentMouseMove, false );
	document.addEventListener( 'mouseup', onDocumentMouseUp, false );

}

function onDocumentMouseMove( event ) {

	var movementX = event.movementX || event.mozMovementX || event.webkitMovementX || 0;
	var movementY = event.movementY || event.mozMovementY || event.webkitMovementY || 0;

	lon -= movementX * 0.1;
	lat += movementY * 0.1;

}

function onDocumentMouseUp( event ) {

	document.removeEventListener( 'mousemove', onDocumentMouseMove );
	document.removeEventListener( 'mouseup', onDocumentMouseUp );

}

function onDocumentMouseWheel( event ) {

	camera.fov -= event.wheelDeltaY * 0.05;
	camera.updateProjectionMatrix();

}

function onDocumentTouchStart( event ) {

	event.preventDefault();

	var touch = event.touches[ 0 ];

	touchX = touch.screenX;
	touchY = touch.screenY;

}

function onDocumentTouchMove( event ) {

	event.preventDefault();

	var touch = event.touches[ 0 ];

	lon -= ( touch.screenX - touchX ) * 0.1;
	lat += ( touch.screenY - touchY ) * 0.1;

	touchX = touch.screenX;
	touchY = touch.screenY;

}

function animate() {

	requestAnimationFrame( animate );

	lon +=  0.15;
	lat = Math.max( - 85, Math.min( 85, lat ) );
	phi = ( 90 - lat ) * Math.PI / 180;
	theta = lon * Math.PI / 180;

	target.x = Math.sin( phi ) * Math.cos( theta );
	target.y = Math.cos( phi );
	target.z = Math.sin( phi ) * Math.sin( theta );

	camera.lookAt( target );

	renderer.render( scene, camera );

}