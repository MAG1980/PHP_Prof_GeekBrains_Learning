document.addEventListener( 'DOMContentLoaded', () => {
	console.log( 'ready' )
	const Order = document.querySelector( '.order' );
	const CartTable = document.querySelector( '.cart__table' );
	const count = document.getElementById( 'count' );
	const ButtonsBuy = document.querySelectorAll( '.buy' );
	const ButtonsRemove = document.querySelectorAll( '.remove' );
	const OrderIssueButton = document.querySelector( '.order__issue-button' );
	const OrderSubmitForm = document.querySelector( '.order__submit-form' );
	const OrderConfirmButton = document.querySelector( '.order-confirm-button' );
	ButtonsBuy.forEach( ( button ) => {
		button.addEventListener( 'click', async () => {
			console.log( 'click' );
			let id = button.getAttribute( 'data-id' );
			let price = button.getAttribute( 'data-price' );
			console.log( price );

			const Parent = button.parentElement;
			let number = Parent.querySelector( '.item_number' ).value;
			let totalPrice = Parent.querySelector( ".item_total-price" ).textContent;

			const data = {
				'id': id,
				'price': price,
				'number': number,
				'totalPrice': totalPrice
			};
			console.log( data );

			const answer = await fetchData( '/cart/add/', data ).then( ( response ) => getData( response ) );

			if ( answer.status === 'ok' ) {
				count.textContent = answer.count;
			}
		} )
	} )

	ButtonsRemove.forEach( ( button ) => {
		button.addEventListener( 'click', async () => {
			let id = button.getAttribute( 'data-id' );
			const data = { 'id': id }
			const answer = await fetchData( '/cart/remove/', data ).then( ( response ) => getData( response ) );
			console.log( answer );
			if ( answer.status === 'ok' ) {
				count.textContent = answer.count;
				document.querySelector( '.cart__row-' + id ).remove();
				console.log( ('cart__row-' + id + ' removed') )
				orderPriceCount();
			}
		} )
	} )

	if ( OrderIssueButton ) {
		OrderIssueButton.addEventListener( 'click', () => {
			OrderIssueButton.classList.add( 'dn' );
			OrderSubmitForm.classList.remove( 'dn' );
		} )
	}

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
			} )
			console.log( rowsPrices );
			orderPrice = rowsPrices.reduce( ( acc, price ) => {
				return acc += price;
			} )
		} else {
			if ( CartTable ) {
				CartTable.textContent = "Ваша корзина пуста!"
			}
		}

		console.log( orderPrice );
		const OrderPrice = document.querySelector( '.cart__order-price' );
		if ( OrderPrice ) {
			OrderPrice.textContent = orderPrice;
			console.log( OrderPrice );
		}
	}

	if ( OrderConfirmButton ) {
		OrderConfirmButton.addEventListener( 'click', async ( event ) => {
			console.log( 'click' );
			event.preventDefault();
			let OrderForm = document.forms.order__form;
			let cart_session = OrderForm.cart_session.value;
			let customer_name = OrderForm.customer_name.value;
			let phone_number = OrderForm.phone_number.value;
			let email = OrderForm.email.value;
			const totalPrice = +document.querySelector( '.cart__order-price' ).textContent;
			console.log( cart_session, customer_name, phone_number );
			const data = {
				'cart_session': cart_session,
				'customer_name': customer_name,
				'phone_number': phone_number,
				'email': email,
				'total_price': totalPrice
			};
			const answer = await fetchData( '/order/add/', data ).then( ( response ) => getData( response ) );

			if ( answer.status === 'ok' ) {
				count.textContent = 0;
				Order.textContent = `Заказ №${ answer.order_id } успешно оформлен!`;
			}
		} )
	}

	async function fetchData( url, data ) {
		const response = await fetch( url,
			{
				method: 'POST',
				body: JSON.stringify( data ), // данные могут быть 'строкой' или {объектом}!
				headers: {
					'Content-Type': 'application/json'
				}
			} )
		return response;
	}

	async function getData( response ) {
		const answer = await response.json();
		return answer;
	}
} )