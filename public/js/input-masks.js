/**
 * Input Masks for Sdew Educacional
 * Provides formatting for various document types and values
 */

(function() {
    'use strict';

    /**
     * Apply mask to an input element
     */
    function applyMask(input, mask, options = {}) {
        if (!input) return;
        
        input.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            let maskedValue = '';
            let maskIndex = 0;
            
            for (let i = 0; i < value.length && maskIndex < mask.length; i++) {
                while (maskIndex < mask.length && mask[maskIndex] !== '9') {
                    maskedValue += mask[maskIndex];
                    maskIndex++;
                }
                if (maskIndex < mask.length) {
                    maskedValue += value[i];
                    maskIndex++;
                }
            }
            
            e.target.value = maskedValue;
        });
    }

    /**
     * Apply CPF mask (000.000.000-00)
     */
    function applyCPFMask(input) {
        if (!input) return;
        
        input.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length <= 11) {
                value = value.replace(/(\d{3})(\d)/, '$1.$2');
                value = value.replace(/(\d{3})(\d)/, '$1.$2');
                value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
            }
            e.target.value = value;
        });
    }

    /**
     * Apply CNPJ mask (00.000.000/0000-00)
     */
    function applyCNPJMask(input) {
        if (!input) return;
        
        input.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length <= 14) {
                value = value.replace(/^(\d{2})(\d)/, '$1.$2');
                value = value.replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3');
                value = value.replace(/\.(\d{3})(\d)/, '.$1/$2');
                value = value.replace(/(\d{4})(\d)/, '$1-$2');
            }
            e.target.value = value;
        });
    }

    /**
     * Apply RG mask (00.000.000-0)
     */
    function applyRGMask(input) {
        if (!input) return;
        
        input.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length <= 9) {
                value = value.replace(/(\d{2})(\d)/, '$1.$2');
                value = value.replace(/(\d{3})(\d)/, '$1.$2');
                value = value.replace(/(\d{3})(\d{1})$/, '$1-$2');
            }
            e.target.value = value;
        });
    }

    /**
     * Apply Phone mask ((00) 0000-0000)
     */
    function applyPhoneMask(input) {
        if (!input) return;
        
        input.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length <= 10) {
                value = value.replace(/^(\d{2})(\d)/, '($1) $2');
                value = value.replace(/(\d{4})(\d)/, '$1-$2');
            }
            e.target.value = value;
        });
    }

    /**
     * Apply Cell Phone mask ((00) 00000-0000)
     */
    function applyCellPhoneMask(input) {
        if (!input) return;
        
        input.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length <= 11) {
                value = value.replace(/^(\d{2})(\d)/, '($1) $2');
                value = value.replace(/(\d{5})(\d)/, '$1-$2');
            }
            e.target.value = value;
        });
    }

    /**
     * Apply CEP mask (00000-000)
     */
    function applyCEPMask(input) {
        if (!input) return;
        
        input.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length <= 8) {
                value = value.replace(/^(\d{5})(\d)/, '$1-$2');
            }
            e.target.value = value;
        });
    }

    /**
     * Apply Currency mask (R$ 0.000,00)
     */
    function applyCurrencyMask(input) {
        if (!input) return;
        
        input.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            value = (parseInt(value) / 100).toFixed(2);
            value = value.replace('.', ',');
            value = value.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
            e.target.value = 'R$ ' + value;
        });
        
        // Remove mask before form submission
        input.form?.addEventListener('submit', function() {
            let value = input.value.replace(/\D/g, '');
            input.value = (parseInt(value) / 100).toFixed(2);
        });
    }

    /**
     * Initialize all masks on page load
     */
    function initializeMasks() {
        // CPF masks
        document.querySelectorAll('input[name="cpf"], input[id="cpf"], input[data-mask="cpf"]').forEach(applyCPFMask);
        
        // CNPJ masks
        document.querySelectorAll('input[name="cnpj"], input[id="cnpj"], input[data-mask="cnpj"]').forEach(applyCNPJMask);
        
        // RG masks
        document.querySelectorAll('input[name="rg"], input[id="rg"], input[data-mask="rg"]').forEach(applyRGMask);
        
        // Phone masks
        document.querySelectorAll('input[name="telefone"], input[id="telefone"], input[data-mask="phone"]').forEach(applyPhoneMask);
        
        // Cell phone masks
        document.querySelectorAll('input[name="celular"], input[id="celular"], input[data-mask="cellphone"]').forEach(applyCellPhoneMask);
        
        // CEP masks
        document.querySelectorAll('input[name="cep"], input[id="cep"], input[data-mask="cep"]').forEach(applyCEPMask);
        
        // Currency masks
        document.querySelectorAll('input[data-mask="currency"], input[name*="valor"], input[name*="preco"]').forEach(applyCurrencyMask);
    }

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initializeMasks);
    } else {
        initializeMasks();
    }

    // Re-initialize when dynamic content is loaded (for AJAX)
    window.reinitializeMasks = initializeMasks;
})();
