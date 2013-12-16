-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Дек 16 2013 г., 03:13
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `alt_recepti`
--

-- --------------------------------------------------------

--
-- Структура таблицы `quote`
--

CREATE TABLE IF NOT EXISTS `quote` (
  `quote_id` int(11) NOT NULL AUTO_INCREMENT,
  `visibility` tinyint(1) NOT NULL,
  `text` text NOT NULL,
  `author` varchar(255) NOT NULL,
  PRIMARY KEY (`quote_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=54 ;

--
-- Дамп данных таблицы `quote`
--

INSERT INTO `quote` (`quote_id`, `visibility`, `text`, `author`) VALUES
(1, 1, 'Человек есть то, что он ест.', 'Людвиг Фейербах'),
(2, 1, 'Хочешь продлить свою жизнь, - укороти свои трапезы.', 'Бенджамин Франклин'),
(3, 1, 'После хорошего обеда можно простить кого угодно, даже своих родственников.', 'Оскар Уайльд'),
(4, 1, 'Одни едят, чтобы жить, другие с той же целью голодают.', 'Александр Пушкин'),
(5, 1, 'Не откладывай до ужина того, что можешь съесть за обедом.', 'Александр Пушкин'),
(6, 1, 'Мне кажется, что всякий муж предпочитает хорошее блюдо без музыки музыке без хорошего блюда.', 'Иммануил Кант'),
(7, 1, 'Люди дурные живут для того, чтобы есть и пить, люди добродетельные едят и пьют для того, чтобы жить.', 'Сократ'),
(8, 1, 'Животные кормятся, люди едят; но только умные люди умеют есть.', 'Ансельм Ббрилья-Саварен'),
(9, 1, 'Голод – лучшая приправа к еде.', 'Сократ'),
(10, 1, 'Война войной, а обед – по расписанию.', 'Фридрих Вильгельм I'),
(11, 1, 'Аппетит приходит во время еды.', 'Франсуа Рабле'),
(12, 1, 'Вы должны любить то, что едите, или любить человека, которому готовите. Приготовление еды – это акт любви.', 'Ален Шапель'),
(13, 1, 'Если в стране нет по меньшей мере пятидесяти сортов сыра и хорошего вина, значит, страна дошла до ручки.', 'Сальводор Дали'),
(14, 1, 'При крупных неприятностях я отказываю себе во всём, кроме еды и питья.', 'Оскар Уайльд'),
(15, 1, 'Для нормального японца нет ничего ужаснее, чем рис, потерявший свою белизну.', 'Харуки Мураками'),
(16, 1, 'У итальянца в голове только две мысли; вторая – это спагетти', 'Катрин Денёв'),
(17, 1, 'В тарелке должна быть одна часть жестокости – перец, уксус, пряности, три части силы и шесть частей нежности.', 'Эмиль Юн'),
(18, 1, 'Хороший повар - это много характера и чувства.', 'Эмиль Юн'),
(19, 1, 'Когда вы пробуете простое на первый взгляд блюдо высокой кухни (haute cuisine), вы чувствуете, как открывается величие повара.', 'Эмиль Юн'),
(20, 1, 'Я вегетарианец не потому, что я люблю животных, - просто я ненавижу растения.', 'Уитни Браун'),
(21, 1, 'Животные – это мои друзья… и я не ем своих друзей.', 'Бернард Шоу'),
(22, 1, 'Сыр помогает переварить всё, кроме самого себя.', 'Джеймс Джонс'),
(23, 1, 'В театре жизни главное — буфет.', 'Геннадии Малкин'),
(24, 1, 'Ничто так не разделяет людей, как вкус, и не объединяет, как аппетит.', 'Борис Крутиер'),
(25, 1, '"Быстрое питание" - пищевой эквивалент порнографии.', 'Стив Элберт'),
(26, 1, 'Со временем мы придём к убеждению, что консервы - оружие более страшное, чем пулемёт.', 'Джордж Оруэлл'),
(27, 1, 'Чаще теряют меру в питье, чем в еде.', 'Пифагор Самосский'),
(28, 1, 'Ничто так не улучшает вкуса домашних блюд, как изучение цен в ресторане.', 'Неизвестный автор'),
(29, 1, 'Аппетит приходит во время еды - особенно если едите не вы.', 'Ян Климек'),
(30, 1, 'Женщины едят за разговорами, мужчины разговаривают за едой.', 'Малькольм де Шазаль'),
(31, 1, 'Плохо, если жена умеет готовить, но не хочет; еще хуже, если она не умеет, но хочет.', 'Роберт Фрост'),
(32, 1, 'Никогда не спорь за обедом: тот, кто голоднее, всегда проигрывает.', 'Неизвестный автор'),
(33, 1, 'Секс - отличный способ похудеть.', 'Джули Ньюмар'),
(34, 1, 'Диета - еще одно средство, улучшающее аппетит.', 'Эван Эзар'),
(35, 1, 'Когда мужчина готовит, он никого не терпит рядом с собой. Но если готовит женщина, он то и дело лезет на кухню.', 'Люсиль Болл'),
(36, 1, 'Тостер: прибор, позволяющий приготовлять два вида гренок по вашему вкусу – обгоревшие и недожаренные.', 'Сэм Левенсон'),
(37, 1, 'Голод – плохой повар.', 'Бертольд Брехт'),
(38, 1, 'Любовь и голод правят миром.', 'Фридрих Шиллер'),
(39, 1, 'Обильная еда вредит телу так же, как изобилие воды вредит посеву.', 'Абу-ль-Фарадж'),
(40, 1, 'Нет плохих продуктов - есть плохие повара', 'Неизвестный автор'),
(41, 1, 'Поглощение пищи - удовольствие, переедание - преступление.', 'Аллен Карр'),
(42, 1, 'Без меня этот шоколад – ничто. Но стоит его положить мне в рот, и он становится удовольствием. Он нуждается во мне.', 'Амели Нотомб'),
(43, 1, 'Если у Вас и седьмой блин комом, к черту блины - пеките комочки...', 'Неизвестный автор'),
(44, 1, 'Диетолог сказал кушать только вареное...учусь варить шашлык...', 'Неизвестный автор'),
(45, 1, 'С того момента как древние люди впервые вкусили жаренную пищу, человек стал есть больше, чем нужно для организма.', 'Бенджамин Франклин'),
(46, 1, 'В СССР полнота означала достаток. В развитых странах - наоборот, бедность. Качество еды важнее количества. По край не менее для обеспеченных.', 'Джон Кэй'),
(47, 1, 'Еда не менее сложная наука, чем физика или химия.', 'Гордон Рамзи'),
(48, 1, 'Джентльмен никогда не ест. Он только завтракает, обедает и ужинает.', 'Коул Портер'),
(49, 1, 'Лучшая часть обеда — десерт, но, когда его подают, ты обычно уже ничего съесть не можешь.', 'Неизвестный автор'),
(50, 1, 'Некий римлянин, пообедав в одиночестве, сказал: "Сегодня я поел, но не пообедал".', 'Плутарх'),
(51, 1, 'Я не люблю шпинат и считаю, что мне повезло: ведь если бы я его любил, мне бы пришлось его есть, а я его ненавижу.', 'Квентин Крисп'),
(52, 1, 'Чем дольше ешь лобстер, тем больше остается на тарелке.', 'Неизвестный автор'),
(53, 1, 'Самое вкусное мясо не похоже на мясо, а самая вкусная рыба не похожа на рыбу.', 'Филоксен');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
