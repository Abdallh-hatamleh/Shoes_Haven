///  Aside bar
const aside_informations = document.querySelector('.aside-informations')
const aside_pass = document.querySelector('.aside-pass')
const aside_orders = document.querySelector('.aside-orders')

///  info section
const info_form = document.querySelectorAll('.user-info-show')[0]
const pass_form = document.querySelectorAll('.user-info-show')[1]
const user_orders_list = document.querySelectorAll('.user-info-show')[2]

///  orders list expand/shrink
const order_expanded_list = document.querySelectorAll('.order-expanded-list')
const order_shrink_pointer = document.querySelectorAll('.order-shrink-pointer')
const order_expand_pointer = document.querySelectorAll('.order-expand-pointer')



aside_informations.addEventListener('click', () => {
    info_form.classList.remove('hidden')
    pass_form.classList.add('hidden')
    user_orders_list.classList.add('hidden')
    ///
    aside_informations.style.color = '#F39102'
    aside_pass.style.color = 'white'
    aside_orders.style.color = 'white'
})

aside_pass.addEventListener('click', () => {
    info_form.classList.add('hidden')
    pass_form.classList.remove('hidden')
    user_orders_list.classList.add('hidden')
    ///
    aside_informations.style.color = 'white'
    aside_pass.style.color = '#F39102'
    aside_orders.style.color = 'white'
})

aside_orders.addEventListener('click', () => {
    info_form.classList.add('hidden')
    pass_form.classList.add('hidden')
    user_orders_list.classList.remove('hidden')
    ///
    aside_informations.style.color = 'white'
    aside_pass.style.color = 'white'
    aside_orders.style.color = '#F39102'
})



function list_hidden_function() {
    for (let i = 0; i < order_expanded_list.length; i++) {
        order_expanded_list[i].classList.add('hidden')
        order_shrink_pointer[i].classList.add('hidden')
        order_expand_pointer[i].classList.remove('hidden')
    }
}

list_hidden_function();

document.querySelector('.user-orders-list').addEventListener('click', (e) => {
    if (e.target.getAttribute('class') == 'order-expand-pointer') {
        x = e.target.parentNode.getAttribute('id')
        list_hidden_function();
        e.target.parentNode.querySelectorAll('a')[3].classList.remove('hidden')
        e.target.classList.add('hidden')
        order_expanded_list[x].classList.remove('hidden')
    } else if (e.target.getAttribute('class') == 'order-shrink-pointer') {
        list_hidden_function();
    }
})