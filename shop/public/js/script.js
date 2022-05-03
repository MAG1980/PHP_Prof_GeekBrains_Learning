document.addEventListener( 'DOMContentLoaded', () => {
	console.log( 'ready' )
	const count = document.getElementById( 'count' );
	const ButtonsBuy = document.querySelectorAll( '.buy' );
	ButtonsBuy.forEach( ( button ) => {
		button.addEventListener( 'click', () => {
			let id = button.getAttribute( 'data-id' );
			let price = button.getAttribute( 'data-price' );
			console.log( price );
			const data = {
				'id': id,
				'price': price
			};
			console.log( data );
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

	const AmountInputs = document.querySelectorAll( '.item_number' );

	const totalPriceCalc = ( event ) => {
		const currentInput = event.target;
		const parentDiv = currentInput.parentElement;
		console.log( parentDiv );
		let itemPrice = parentDiv.querySelector( '.item_price' ).textContent;

		const totalPrice = parentDiv.querySelector( '.item_total-price' );
		currentInput.addEventListener( 'change', ( event ) => {
			let itemNumber = parentDiv.querySelector( '.item_number' ).value;
			totalPrice.textContent = Number( itemPrice ) * Number( itemNumber );
		} )
	}

	AmountInputs.forEach( ( input ) => {

		input.addEventListener( 'focus', ( event ) => {
			input.addEventListener( 'focusin', totalPriceCalc );
			input.style.background = 'green';
			console.log( "input in focus" );
		} )

		input.addEventListener( 'blur', () => {
			input.removeEventListener( 'focusout', totalPriceCalc );
			input.style.background = 'white';
			console.log( "input out of focus" );
		} )


	} )

} )