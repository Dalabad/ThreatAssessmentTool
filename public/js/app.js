/**
 * Created by daniel on 20.10.15.
 */

$(function () {
    $("#inputCompanyName")
        .popover({
            title: 'Company Name',
            content: "The company name is needed, so we can verify the findings against it."
        })
        .blur(function () {
            $(this).popover('hide');
        });
    $("#inputCompanySize")
        .popover({
            title: 'Amount of Employees',
            content: "We need the amount of employees to evaluate the amount of findings against it and give a valuable threat assessment."
        })
        .blur(function () {
            $(this).popover('hide');
        });
    $("#inputCompanyWebsite")
        .popover({
            title: 'Company Website',
            content: "The company website is the starting point of our research and might also give information about employees email adresses."
        })
        .blur(function () {
            $(this).popover('hide');
        });
    $("#selectAttackType")
        .popover({
            trigger: 'focus',
            title: 'Attack Type',
            content: "Based on the attack type a set of characteristics will be chosen, against which we will gather information."
        })
        .blur(function () {
            $(this).popover('hide');
        });
});