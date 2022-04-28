document.addEventListener( 'DOMContentLoaded', () => {
	console.log( 'ready' )
	const count = document.getElementById( 'count' );
	const ButtonsBuy = document.querySelectorAll( '.buy' );
	ButtonsBuy.forEach( ( button ) => {
		button.addEventListener( 'click', () => {
			let id = button.getAttribute( 'data-id' );
			const data = { 'id': id };

			(async () => {
					const response = await fetch( '/cart/add/',
						{
							method: 'POST',
							body: JSON.stringify( data ), // данные могут быть 'строкой' или {объектом}!
							headers: {
								'Content-Type': 'application/json'
							}
						} )
					const answer = await response.json();
					console.log( answer );
					console.log( count );
					count.textContent = answer.count;

				}
			)()
		} )
	} )
	const ButtonsRemove = document.querySelectorAll( '.remove' );
	ButtonsRemove.forEach( ( button ) => {
		button.addEventListener( 'click', () => {
			let id = button.getAttribute( 'data-id' );
			console.log( id );
			const data = { 'id': id }
			console.log( data );
			(async () => {
					const response = await fetch( '/cart/remove/',
						{
							method: 'POST',
							body: JSON.stringify( data ), // данные могут быть 'строкой' или {объектом}!
							headers: {
								'Content-Type': 'application/json'
							}
						} )
					const answer = await response.json();
					console.log( answer );
					if ( answer.status === 'ok' ) {
						count.textContent = answer.count;
						document.querySelector( '.cart__row-' + id ).remove();
						console.log( ('cart__row-' + id + ' removed') )
					}
				}
			)()
		} )
	} )

} )

