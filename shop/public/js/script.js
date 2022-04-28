document.addEventListener( 'DOMContentLoaded', () => {
	console.log( 'ready' )
	const count = document.getElementById( 'count' );
	const Buttons = document.querySelectorAll( '.buy' );
	console.log( Buttons );
	Buttons.forEach( ( button ) => {
		button.addEventListener( 'click', () => {
			let id = button.getAttribute( 'data-id' );
			console.log( id );
			(async () => {
					const response = await fetch( '/cart/add/?id=' + id );
					const answer = await response.json();
					console.log( answer );
					console.log( count );
					count.textContent = answer.count;

				}
			)()
		} )
	} )
} )

