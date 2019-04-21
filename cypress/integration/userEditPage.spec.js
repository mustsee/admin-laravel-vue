describe('Users Page', function() {
    beforeEach(() => {
        cy.visit('/users/create', {
            auth: {
                username: Cypress.env('test_mail'),
                password: Cypress.env('test_password'),
            }
        });
    });

    it('Fills user form, validate it and return to user page', function() {
        // Mock server response onClick
        cy.server();
        cy.route({
            method: 'POST',
            url: '/api/users',
            response: { data: { message: 'Successfully created user'}}
        });

        // Fill the form
        cy.get('#inspire > div > main > div > div > div > div > form > div:nth-child(1) > div > div.v-input__slot > div > input[type="text"]')
            .type('test')
            .should('have.value', 'test');
        cy.get('#inspire > div > main > div > div > div > div > form > div:nth-child(2) > div > div.v-input__slot > div > input[type="text"]')
            .type('test@gmail.com')
            .should('have.value', 'test@gmail.com');
        cy.get('#inspire > div > main > div > div > div > div > form > div:nth-child(3) > div > div.v-input__slot > div > input[type="text"]')
            .type('password')
            .should('have.value', 'password');

        // Click on it
        cy.get('button').contains('Create').click();

        // Should return to /users
        cy.url().should('eq', 'http://localhost:8000/#/users')
    });
});