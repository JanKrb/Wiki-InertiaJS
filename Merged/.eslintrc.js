module.exports = {
    root: true,
    env: {
        node: true
    },
    extends: ['plugin:vue/vue3-essential', '@vue/standard'],
    parserOptions: {
        parser: '@babel/eslint-parser'
    },
    rules: {
        eqeqeq: 'off',
        'no-new': 'off',
        'no-unused-expressions': 'off',
        'space-before-function-paren': 'off',
        indent: ['error', 4],
        'no-console': process.env.NODE_ENV === 'production' ? 'warn' : 'off',
        'no-debugger': process.env.NODE_ENV === 'production' ? 'warn' : 'off'
    },
    globals: {
        cash: true
    }
}
