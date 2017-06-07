(function ($) {
    setTimeout(function () {
        jQuery('.faqwd_conteiner').each(function (k, v) {
            jQuery(this).find('.faqwd_cat_desc').hide();
            if (jQuery(this).find('.faqwd_categories').attr("class") == "faqwd_categories faqwd_hidden") {
                jQuery(this).find(".faqwd_cat").show();
            } else {
                jQuery(this).find('.faqwd_categories_li:first').addClass("faqwd_cat_current");
                var current_id = jQuery(this).find('.faqwd_categories_li:first').data('catid');
                jQuery(this).find('.faqwd_cat_desc_' + current_id).show();
                jQuery(this).find('.faqwd_questions .faqwd_cat_' + current_id).show();
            }
            if (jQuery(this).find(".faqwd_question_li").hasClass('expanded')) {
                jQuery(this).find(".faqwd_question_title_container").each(function () {
                    $(this).addClass('opened');
                });
            } else {
                jQuery(this).find(".faqwd_question_li .faqwd_question_content").hide();
            }
            expand_collapse('text', $(this));

        });

    }, 500);


    jQuery(".faqwd_categories_li").on("click", function () {
        $(this).closest('.faqwd_conteiner').find('.faqwd_categories_li').removeClass("faqwd_cat_current");
        $(this).addClass("faqwd_cat_current");
        $(this).closest('.faqwd_conteiner').find('.faqwd_cat').hide();
        $(this).closest('.faqwd_conteiner').find('.faqwd_cat_desc').hide();
        var cat_id = $(this).attr('class');
        cat_id = cat_id.split(" ")[1];
        var id = cat_id.split("_")[3];
        var quest_class = ".faqwd_cat_" + id;
        var cat_desc_class = ".faqwd_cat_desc_" + id;
        $(this).closest('.faqwd_conteiner').find(quest_class).show();
        $(this).closest('.faqwd_conteiner').find(cat_desc_class).show();
        expand_collapse('text', $(this));
    });


    jQuery('.faqwd_question_li .faqwd_question_title_container').on("click", function () {
        var content_class = ".faqwd_question_" + $(this).data('faqid');
        if ($(this).closest('.faqwd_questions_ul').find(content_class).is(':visible')) {
            $(this).closest('.faqwd_questions_ul').find(content_class).slideUp("slow");
            jQuery(this).removeClass('opened');
        }
        else {
            $(this).closest('.faqwd_questions_ul').find(content_class).slideDown("slow");
            jQuery(this).addClass('opened');
        }
        expand_collapse('text', $(this));
    });

    jQuery('.faqwd_expand').on("click", function () {
        $(this).closest('.faqwd_conteiner ').find('.faqwd_question_content').slideDown("slow");
        $(this).closest('.faqwd_conteiner ').find(".faqwd_question_title_container").each(function () {
            jQuery(this).addClass('opened');
        });
        expand_collapse('faqwd_expand', $(this));
    });
    jQuery('.faqwd_collapse').on("click", function () {
        $(this).closest('.faqwd_conteiner ').find('.faqwd_question_content').slideUp("slow");
        $(this).closest('.faqwd_conteiner ').find(".faqwd_question_title_container").each(function () {
            jQuery(this).removeClass('opened');
        });
        expand_collapse('faqwd_collapse', $(this));
    });


    function expand_collapse(text, el) {
        $(el).closest('.faqwd_conteiner ').find('.faqwd_expand').next('span').hide();
        if (text == 'faqwd_collapse') {
            $(el).closest('.faqwd_conteiner ').find('.faqwd_expand').show();
            $(el).closest('.faqwd_conteiner ').find('.faqwd_collapse').hide();
            return 0;
        }
        if (text == 'faqwd_expand') {
            $(el).closest('.faqwd_conteiner ').find('.faqwd_collapse').show();
            $(el).closest('.faqwd_conteiner ').find('.faqwd_expand').hide();

            return 0;
        }

        var collapse = "no";
        var expand = "no";

        var current = el.closest('.faqwd_conteiner').find('.faqwd_cat_current').attr('class');
        var cat_id = jQuery("." + current + "").data('catid');
        el.closest('.faqwd_conteiner').find(".faqwd_questions " + cat_id + " .faqwd_question_title_container").each(function () {
            if ($(this).attr('class') == 'faqwd_question_title_container opened') {

            }
        });

        $(el).closest('.faqwd_conteiner').find(".faqwd_question_title_container ").each(function () {
            if (jQuery(this).attr('class') == "faqwd_question_title_container opened" && collapse == "no") {
                collapse = "yes";
            }
            if (jQuery(this).attr('class') == "faqwd_question_title_container" && expand == "no") {
                expand = "yes";
            }
        });
        if (collapse == "yes") {
            $(el).closest('.faqwd_conteiner ').find('.faqwd_collapse').show();
        }
        else {
            $(el).closest('.faqwd_conteiner ').find('.faqwd_collapse').hide();
        }
        if (expand == "yes") {
            $(el).closest('.faqwd_conteiner ').find('.faqwd_expand').show();
        }
        else {
            $(el).closest('.faqwd_conteiner ').find('.faqwd_expand').hide();
        }
        if (collapse == "yes" && expand == "yes") {
            $(el).closest('.faqwd_conteiner ').find('.faqwd_expand').next('span').show();
        }
    }

    var $faqwd_search = jQuery('.faqwd_search');
    if ($faqwd_search.length > 0) {
        $faqwd_search.each(function () {
            var faqwd_search_obj = new faqwd_search(jQuery(this));
            faqwd_search_obj.init();
        });
    }

    /**/
    function faqwd_search($container) {
        var _this = this;

        this.$container = $container;
        this.$search_button = null;
        this.$search_input = null;
        /*{id:{"question":"","answer":""},}*/
        this.question_answer = {};
        this.search_text = '';
        this.is_search_view = false;
        this.visible_nummbering = false;
        this.autocomplete = false;

        this.init = function () {
            this.$search_button = this.$container.find('.faqwd_search_button');
            this.$search_input = this.$container.find('.faqwd_search_input');
            this.visible_nummbering = this.$container.closest('.faqwd_conteiner').find('.faqwd_quest_numbering').is(":visible");
            this.$container.closest('.faqwd_conteiner').find('.faqwd_questions').prepend('<div class="faqwd_search_result faqwd_hidden"></div>');


            this.autocomplete = (typeof  faqwd.options.faq_search_autocomplete !== 'undefined' && faqwd.options.faq_search_autocomplete == 1);
            if (this.autocomplete) {
                this.init_autocomplete();
            }

            this.set_question_answer();

            this.add_events_listener();
        };

        this.add_events_listener = function () {

            this.$search_button.on('click', function () {
                _this.search();
            });

            this.$search_input.on('keyup', function (e) {
                if (_this.autocomplete == true) {
                    if (e.keyCode == 40 || e.keyCode == 38) {
                        _this.autocomplete_change_selected(e);
                    } else {
                        _this.autocomplete_keyup(e);
                    }

                    jQuery(document).mouseup(function (e) {
                        var container = _this.$container.closest(".faqwd_search");
                        if (!container.is(e.target) && container.has(e.target).length === 0) {
                            container.find('.faqwd_autocomplete').addClass('faqwd_hidden');
                        }
                    });

                } else {
                    if (e.keyCode == 13) {
                        _this.search();
                    }
                }
            });
        };


        this.search = function () {
            _this.search_text = _this.$search_input.val();
            if (_this.search_text == '') {
                _this.restor_faq();
                return;
            }
            var search_data = _this.get_search_data();
            if (Object.keys(search_data).length === 0) {
                this.add_search_text('.faqwd_search_text1');
                return;
            }
            _this.serach_view(search_data);
        };

        /*
         * return{
         *   question_id:{
         *       "answer": "...",
         *       "answer_position": -1,0,...,
         *       "question":"...",
         *       "question_position": -1,0,...,
         *       "categories": []
         *   },...
         * }
         *
         * */
        this.get_search_data = function () {
            var search_data = {};
            var answer_lower, question_lower;
            var text_lower = this.search_text.toLowerCase();
            for (var question_id in this.question_answer) {
                answer_lower = this.question_answer[question_id]['answer'].toLowerCase().replace(/(?:\r\n|\r|\n)/g, ' ');
                question_lower = this.question_answer[question_id]['question'].toLowerCase();
                search_data[question_id] = {
                    'answer': this.question_answer[question_id]['answer'],
                    'answer_position': answer_lower.indexOf(text_lower),
                    'question': this.question_answer[question_id]['question'],
                    'question_position': question_lower.indexOf(text_lower),
                };
            }
            return search_data;
        };

        this.restor_faq = function () {
            jQuery('.faqwd_categories_li:first').click();
            if (this.is_search_view == false) {
                return;
            }
            _this.$container.closest('.faqwd_conteiner').find('.faqwd_search_result').addClass("faqwd_hidden");
            _this.$container.closest('.faqwd_conteiner').find('.faqwd_cat').addClass("faqwd_hidden");
            _this.$container.closest('.faqwd_conteiner').find('.faqwd_cat').first().removeClass("faqwd_hidden");
            _this.$container.closest('.faqwd_conteiner').find('.faqwd_categories').removeClass("faqwd_hidden");
            _this.$container.closest('.faqwd_conteiner').find('.faqwd_question_li').removeClass("faqwd_hidden");
            if (_this.visible_nummbering) {
                _this.$container.closest('.faqwd_conteiner').find('.faqwd_question_li .faqwd_quest_numbering').removeClass("faqwd_hidden");
            }


            this.is_search_view = false;
        };

        this.serach_view = function (search_data) {

            _this.$container.closest('.faqwd_conteiner').find('.faqwd_cat').removeClass("faqwd_hidden");
            _this.$container.closest('.faqwd_conteiner').find('.faqwd_cat').css({
                'display':'block'
            });
            _this.$container.closest('.faqwd_conteiner').find('.faqwd_categories').addClass("faqwd_hidden");
            _this.$container.closest('.faqwd_conteiner').find('.faqwd_question_li').addClass("faqwd_hidden");
            _this.$container.closest('.faqwd_conteiner').find('.faqwd_question_li .faqwd_quest_numbering').addClass("faqwd_hidden");

            var question_id;
            var is_visible_question = false;
            for (question_id in search_data) {
                if (search_data[question_id].answer_position > -1 || search_data[question_id].question_position > -1) {
                    var question_li_selector = '.faqwd_question_li'
                        + '.faqwd_qustion_li_'
                        + this.question_answer[question_id]['categories'][0] + "_" + question_id;
                    _this.$container.closest('.faqwd_conteiner').find(question_li_selector).removeClass('faqwd_hidden')
                    is_visible_question = true;
                }
            }

            if (is_visible_question) {
                this.add_search_text('.faqwd_search_text3');
            } else {
                this.add_search_text('.faqwd_search_text1');
            }

            this.is_search_view = true;
        };

        this.set_question_answer = function () {
            /*Categories each*/
            this.$container.closest('.faqwd_conteiner').find('.faqwd_questions .faqwd_questions_ul').each(function () {
                /*Categories questions each*/
                jQuery(this).find('li.faqwd_question_li').each(function () {
                    var cat_quest_id = jQuery(this).find('.faqwd_question_title_container').data('faqid').split('_');
                    if (typeof _this.question_answer[cat_quest_id[1]] !== "undefined") {
                        _this.question_answer[cat_quest_id[1]]['categories'].push(cat_quest_id[0]);
                        return;
                    }
                    _this.question_answer[cat_quest_id[1]] = {
                        'question': jQuery(this).find('.faqwd_post_title').text(),
                        'answer': jQuery(this).find('.faqwd_answer').text(),
                        'categories': new Array(cat_quest_id[0])
                    };
                });
            });
        };


        this.init_autocomplete = function () {
            _this.$container.append("<div class='faqwd_autocomplete faqwd_hidden'><ul></ul></div>");
        };

        this.autocomplete_keyup = function (e) {
            _this.search_text = _this.$search_input.val();

            if (e.keyCode == 13) {
                if (_this.search_text == '') {
                    _this.restor_faq();
                } else {
                    var autocomplete_selected = _this.$container.find('.faqwd_autocomplete .autocomplete_selected');
                    if (autocomplete_selected.length > 0) {
                        _this.$search_input.val(autocomplete_selected.text());
                    }
                    _this.search();
                    _this.$container.find('.faqwd_autocomplete').addClass("faqwd_hidden");
                    _this.$container.find('.faqwd_autocomplete').find("ul li").remove();
                }
                return;
            }

            _this.$container.find('.faqwd_autocomplete').find("ul li").remove();
            _this.$container.find('.faqwd_autocomplete').addClass("faqwd_hidden");

            var search_data = _this.get_search_data();

            if (Object.keys(search_data).length === 0) {
                _this.$container.find('.faqwd_autocomplete').addClass("faqwd_hidden");
                return;
            }

            var index = 0;
            for (id in search_data) {
                if (index > 5) {
                    break;
                }
                if (search_data[id]['question_position'] < 0) {
                    continue;
                }

                var temp_data = search_data[id];

                var start_pos = temp_data.question_position - 50;
                if (start_pos < 0) {
                    start_pos = 0;
                }

                var text = "";
                text += temp_data['question'].substring(start_pos, temp_data.question_position);

                var word_end_pos = temp_data.question_position + _this.search_text.length;
                text += "<b>" + temp_data.question.substring(temp_data.question_position, word_end_pos) + "</b>";
                text += temp_data.question.substring(word_end_pos, temp_data.question.length - word_end_pos);

                _this.$container.find('.faqwd_autocomplete').find("ul").append("<li>" + temp_data.question + "</li>");
                index++;
            }
            if (index > 0) {
                _this.$container.find('.faqwd_autocomplete').removeClass('faqwd_hidden');
            }

            _this.$container.find('.faqwd_autocomplete').find('li').on('click', function () {
                _this.$search_input.val(jQuery(this).text());
                _this.$container.find('.faqwd_autocomplete').addClass("faqwd_hidden");
            });
        };


        this.autocomplete_change_selected = function (e) {
            var selected = _this.$container.find('.autocomplete_selected');
            var new_selected;
            if (e.keyCode == '40') {
                if (selected.length == 0) {
                    new_selected = _this.$container.find('li').first();
                } else {
                    new_selected = selected.next();
                    if (new_selected.length == 0) {
                        new_selected = _this.$container.find('li').first();
                    }
                }
            } else {
                if (selected.length == 0) {
                    new_selected = _this.$container.find('li').last();
                } else {
                    new_selected = selected.prev();
                    if (new_selected.length == 0) {
                        new_selected = _this.$container.find('li').last();
                    }
                }
            }

            selected.removeClass('autocomplete_selected');
            new_selected.addClass('autocomplete_selected');
            _this.$search_input.val(new_selected.text());
        };

        this.add_search_text = function (code) {
            var text = _this.$container.closest('.faqwd_conteiner').find(code).val();
            _this.$container.closest('.faqwd_conteiner').find('.faqwd_search_result').removeClass("faqwd_hidden");
            _this.$container.closest('.faqwd_conteiner').find('.faqwd_search_result').text(text);
        }
    };
}(jQuery));



