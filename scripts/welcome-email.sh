#!/bin/bash

# ======================================================================
#
# A simple script to send a nice welcoming email to new club members,
# takes the following arguments <first name> <last name> <email>
# 
# example: ./welcome-email.sh John Doe john.doe@gmail.com
#
# ======================================================================

FIRST_NAME="${1}"
LAST_NAME="${2}"
NEW_MEMBER_EMAIL="${3}"

# Club email account and message details
CLUB_EMAIL=''
EMAIL_PASS=''
EMAIL_SUBJECT='Welcome to the Computer Science Club'
SMTP_SERVER='smtp.gmail.com'
SMTP_PORT='465'

# A nice welcoming email message to send to new club members
EMAIL_MESSAGE="<html><body>
<p>${FIRST_NAME} ${LAST_NAME},</p>"'<p>Thank you for joining the Computer Science Club
at UOIT and DC. If you would like to stay up to date with club events please feel free to 
subscribe to the club mailing list below or chat with us on IRC.</p>

<p><a href="https://groups.google.com/forum/#!forum/uoit_csc/join">Subscribe to the Mailing List!</a><br /></p>

<p><h4>IRC Server Details</h4></p>
<ul><li><b>Server:</b> cs-club.ca</li>
<li><b>Port:</b> 6667 or 6697 (for ssl)</li>
<li><b>SSL Support:</b> Supports ssl on port 6697</li></ul>


<p>Cheers,<br/>Computer Science Club</p>

</body>
</html>'


# Send the welcoming email to the new club member from the official 
# CS Club email account (uoit.csc@gmail.com)

smtp-cli --server="${SMTP_SERVER}" --port="${SMTP_PORT}" --ssl --user="${CLUB_EMAIL}" \
--pass="${EMAIL_PASS}" --from="${CLUB_EMAIL}" --to="${NEW_MEMBER_EMAIL}" --subject="${EMAIL_SUBJECT}" \
--body-html="${EMAIL_MESSAGE}"

exit $?
