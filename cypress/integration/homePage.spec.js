describe('Home Page', function() {
    beforeEach(() => {
        cy.visit('/', {
            auth: {
                username: Cypress.env('test_mail'),
                password: Cypress.env('test_password'),
            }
        });
    });

    it('successfully loads', () => {});

    it('Checks if Home is written in the toolbar', function() {
        cy.get('.v-toolbar__title').contains('Home');
    })
});