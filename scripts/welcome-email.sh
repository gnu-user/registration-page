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

<legend><h4>Subscribe to the CS Club Mailing List</h4></b></legend></p>
<form style="border:1px solid #ccc;padding:3px;text-align:left;width:325px;" method="post" action="http://groups.google.com/group/uoit_csc/boxsubscribe">
<input type="hidden" name="hl" value="en" /><br />
&nbsp;&nbsp;&nbsp;<b>E-mail:    </b><input style="border:1px solid #ccc;" type="text" name="email" />
<input style="padding:3px 4px;-webkit-border-radius:2px 2px;border:solid 1px rgb(153, 153, 153);background:-webkit-gradient(linear, 0% 0%, 0% 100%, from(rgb(255, 255, 255)), to(rgb(221, 221, 221)));color: #333;text-decoration:none;cursor:pointer;display:inline-block;text-align:center;text-shadow:0px 1px 1px rgba(255,255,255,1);line-height:1;" type="submit" name="sub" value="Subscribe" />
<br /><br /></form>
<p><a href="http://groups.google.com/group/uoit_csc?hl=en">Visit this group</a><br /></p>

<p><h4>IRC Server Details</h4></p>
<ul><li><b>Server:</b> cs-club.ca</li>
<li><b>Port:</b> 6667 or 6697 (for ssl)</li>
<li><b>SSL Support:</b> Supports ssl on port 6697</li></ul>
</body>
</html>'


# Send the welcoming email to the new club member from the official 
# CS Club email account (uoit.csc@gmail.com)

smtp-cli --server="${SMTP_SERVER}" --port="${SMTP_PORT}" --ssl --user="${CLUB_EMAIL}" \
--pass="${EMAIL_PASS}" --from="${CLUB_EMAIL}" --to="${NEW_MEMBER_EMAIL}" --subject="${EMAIL_SUBJECT}" \
--body-html="${EMAIL_MESSAGE}"

exit $?
