-- MySQL database schema for the GWToolset extension.
-- @license GNU General Public License 3.0 http://www.gnu.org/licenses/gpl.html

CREATE TABLE IF NOT EXISTS /*_*/gwtoolset_mediawiki_templates (
	`mediawiki_template_name` varchar(255) NOT NULL,
	`mediawiki_template_json` blob NOT NULL,
	PRIMARY KEY (`mediawiki_template_name`)
) /*$wgDBTableOptions*/;

-- https://commons.wikimedia.org/wiki/Template:Artwork
INSERT INTO /*_*/gwtoolset_mediawiki_templates ( `mediawiki_template_name`, `mediawiki_template_json` ) VALUES ( 'Artwork', '{"artist":"","title":"","description":"","date":"","medium":"","dimensions":"","institution":"","location":"","references":"","object history":"","exhibition history":"","credit line":"","inscriptions":"","notes":"","accession number":"","source":"","permission":"","other_versions":""}' );

-- https://commons.wikimedia.org/wiki/Template:Book
INSERT INTO /*_*/gwtoolset_mediawiki_templates ( `mediawiki_template_name`, `mediawiki_template_json` ) VALUES ( 'Book', '{"Author":"","Translator":"","Editor":"","Illustrator":"","Title":"","Subtitle":"","Series title":"","Volume":"","Edition":"","Publisher":"","Printer":"","Date":"","City":"","Language":"","Description":"","Source":"","Permission":"","Image":"","Image page":"","Pageoverview":"","Wikisource":"","Homecat":"","Other_versions":"","ISBN":"","LCCN":"","OCLC":""}' );

-- https://commons.wikimedia.org/wiki/Template:Musical_work
INSERT INTO /*_*/gwtoolset_mediawiki_templates ( `mediawiki_template_name`, `mediawiki_template_json` ) VALUES ( 'Musical work', '{"composer":"","lyrics_writer":"","performer":"","title":"","description":"","composition_date":"","performance_date":"","notes":"","record_ID":"","image":"","references":"","source":"","permission":"","other_versions":""}' );

-- https://commons.wikimedia.org/wiki/Template:Photograph
INSERT INTO /*_*/gwtoolset_mediawiki_templates ( `mediawiki_template_name`, `mediawiki_template_json` ) VALUES ( 'Photograph', '{"photographer":"","title":"","description":"","depicted people":"","depicted place":"","date":"","medium":"","dimensions":"","institution":"","department":"","references":"","object history":"","exhibition history":"","credit line":"","inscriptions":"","notes":"","accession number":"","source":"","permission":"","other_versions":""}' );

-- http://commons.wikimedia.org/wiki/Template:Specimen
INSERT INTO /*_*/gwtoolset_mediawiki_templates ( `mediawiki_template_name`, `mediawiki_template_json` ) VALUES ( 'Specimen', '{"taxon":"","authority":"","institution":"","accession number":"","sex":"","discovery place":"","cultivar":"","author":"","source":"","date":"","description":"","period":"","depicted place":"","camera coord":"","dimensions":"","institution":"","location":"","object history":"","exhibition history":"","credit line":"","notes":"","references":"","permission":"","other versions":"","photographer":"","source":""}' );
