///  Aside bar
const aside_informations = document.querySelector('.aside-informations')
const aside_pass = document.querySelector('.aside-pass')
const aside_orders = document.querySelector('.aside-orders')

///  info section
const info_form = document.querySelectorAll('.user-info-show')[0]
const pass_form = document.querySelectorAll('.user-info-show')[1]
const user_orders_list = document.querySelectorAll('.user-info-show')[2]

///  orders list expand/shrink  user-order-card
const user_order_card = document.querySelectorAll('.user-order-card')
const order_expanded_list = document.querySelectorAll('.order-expanded-list')



aside_informations.addEventListener('click', () => {
    info_form.classList.remove('hidden')
    pass_form.classList.add('hidden')
    user_orders_list.classList.add('hidden')
    ///
    list_hidden_function();
    aside_informations.style.color = '#F39102'
    aside_pass.style.color = 'white'
    aside_orders.style.color = 'white'
})

aside_pass.addEventListener('click', () => {
    info_form.classList.add('hidden')
    pass_form.classList.remove('hidden')
    user_orders_list.classList.add('hidden')
    ///
    list_hidden_function();
    aside_informations.style.color = 'white'
    aside_pass.style.color = '#F39102'
    aside_orders.style.color = 'white'
})

aside_orders.addEventListener('click', () => {
    info_form.classList.add('hidden')
    pass_form.classList.add('hidden')
    user_orders_list.classList.remove('hidden')
    ///
    list_hidden_function();
    aside_informations.style.color = 'white'
    aside_pass.style.color = 'white'
    aside_orders.style.color = '#F39102'
})



function list_hidden_function() {
    for (let i = 0; i < order_expanded_list.length; i++) {
        order_expanded_list[i].classList.add('hidden')
        user_order_card[i].querySelectorAll('a')[3].innerHTML = ('&#9660;')
    }
}

list_hidden_function();

document.querySelector('.user-orders-list').addEventListener('click', (e) => {
    let order_card_id = e.target.getAttribute('id')
    let order_card_class = e.target.getAttribute('class')
    if (order_card_class == 'user-order-card' && order_expanded_list[order_card_id].classList.contains('hidden')) {
        list_hidden_function();
        e.target.querySelectorAll('a')[3].innerHTML = ('&#9650;')
        order_expanded_list[order_card_id].classList.remove('hidden')
    } else if (order_card_class == 'user-order-card' && !order_expanded_list[order_card_id].classList.contains('hidden')) {
        list_hidden_function();
    }
})

