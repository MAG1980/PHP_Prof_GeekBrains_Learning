document.addEventListener( 'DOMContentLoaded', () => {
	console.log( 'ready' )
	const CartTable = document.querySelector( '.cart__table' );
	const count = document.getElementById( 'count' );
	const ButtonsBuy = document.querySelectorAll( '.buy' );
	const OrderIssueButton = document.querySelector( '.order__issue-button' );
	const OrderSubmitForm = document.querySelector( '.order__submit-form' );
	ButtonsBuy.forEach( ( button ) => {
		button.addEventListener( 'click', () => {
			let id = button.getAttribute( 'data-id' );
			let price = button.getAttribute( 'data-price' );
			console.log( price );

			const Parent = button.parentElement;
			let number = Parent.querySelector( '.item_number' ).value;
			let totalPrice = Parent.querySelector( ".item_total-price" ).textContent;
			console.log( "totalPrice=", totalPrice );
			const data = {
				'id': id,
				'price': price,
				'number': number,
				'totalPrice': totalPrice
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
						orderPriceCount();
					}
				}
			)()
		} )
	} )

	OrderIssueButton.addEventListener( 'click', () => {
		OrderIssueButton.classList.add( 'dn' );
		OrderSubmitForm.classList.remove( 'dn' );
	} )

	rowsPricesCount();
	orderPriceCount();

	function rowsPricesCount() {
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

		const CartRowTotalPrices = document.querySelectorAll( '.cart__good-total-price' );
		const CartOrderPrice = document.querySelector( '.cart__order-price' );

		CartRowTotalPrices.forEach( ( item ) => {
			const cartRow = item.parentElement;
			const number = +cartRow.querySelector( '.cart__good-quantity' ).textContent;
			const price = +cartRow.querySelector( '.cart__goog-price' ).textContent;
			const rowTotalPriceDiv = cartRow.querySelector( '.cart__good-total-price' );
			rowTotalPriceDiv.textContent = number * price;
		} )
	}

	function orderPriceCount() {
		const CartItemsTotalPrices = document.querySelectorAll( '.cart__good-total-price' );
		console.log( CartItemsTotalPrices );
		const rowsPrices = [];
		let orderPrice = 0;
		if ( CartItemsTotalPrices.length !== 0 ) {
			CartItemsTotalPrices.forEach( item => {
				console.log( +item.textContent );
				rowsPrices.push( +item.textContent );
				console.log( rowsPrices );
			} )
			console.log( rowsPrices );
			orderPrice = rowsPrices.reduce( ( acc, price ) => {
				return acc += price;
			} )
		} else {
			CartTable.textContent = "Ваша корзина пуста!"
		}

		console.log( orderPrice );
		const OrderPrice = document.querySelector( '.cart__order-price' );
		OrderPrice.textContent = orderPrice;
		console.log( OrderPrice );
	}

} )