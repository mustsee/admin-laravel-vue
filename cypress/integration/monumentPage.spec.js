describe('Monument Page', function() {
    beforeEach(() => {
        cy.visit('/monuments', {
            auth: {
                username: Cypress.env('test_mail'),
                password: Cypress.env('test_password'),
            }
        });
    });

    it('Checks if Monument is written in the toolbar', function() {
        cy.get('.v-toolbar__title').contains('Monuments');
    });

    it('Changes the tab when clicking on the second one', function() {
        cy.get('.v-tabs__item').contains('Monument translations').click();
    })
});