const toggleBurger = () => {
    for (const el of [['.header-menu__nav', 'open-menu__nav'], ['.dark-fone', 'show-dark-fone'], ['.header-burger', 'open-menu__burger']]) $(el[0]).toggleClass(el[1]);
}