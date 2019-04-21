describe('Users Page', function() {
    beforeEach(() => {
        cy.visit('/users', {
            auth: {
                username: Cypress.env('test_mail'),
                password: Cypress.env('test_password'),
            }
        });
    });

    console.log(Cypress.env());

    it('Checks if Users is written in the toolbar', function() {
        cy.get('.v-toolbar__title').contains('Users');
    });

    it('Opens create user page on click on add button', function() {
        cy.contains('add').click();
        cy.url().should('include', '/users/create');
    });

    it('Opens a delete modal on click on delete button', function() {
        cy.get('td > i').contains('delete').click();
        cy.get('.v-dialog').should('contain', 'Delete');
    })
});