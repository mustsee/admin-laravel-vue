const cacheName = 'gram-back-office';

const usersAPI = 'api/users';

let token = document.head.querySelector('meta[name="csrf-token"]');

const defaultOptions = {
    credentials: 'same-origin',
    headers: {
        'X-Requested-With': 'XMLHttpRequest'
    },
    method: 'GET'
};

if (token) {
    defaultOptions.headers['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

export { cacheName, defaultOptions, usersAPI };